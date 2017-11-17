<?php

namespace app\models;

use Yii;
use \app\models\base\Enrollment as BaseEnrollment;

/**
 * This is the model class for table "enrollment".
 */
class Enrollment extends BaseEnrollment
{
    /**
     * @inheritdoc
     */
    public $paymentExist = false;

    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['paymentStatus_id','vanService_id','academicYear_id','scheduleType_id','searchprgoram_id','student_id','grade_id','branch_id', 'payTerm_id','enrollType_id', 'discount_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['enrollCode','title','enrollDate', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['snack', 'lunch', 'paymentExist'], 'boolean'],
            [['lock'], 'default', 'value' => '0'],
            [['vanService_id'], 'default', 'value' => '37'],
            [['lock'], 'mootensai\components\OptimisticLockValidator'],
            [['student_id', 'grade_id'], 'unique', 'targetAttribute' => ['student_id', 'grade_id'], 'message' => 'The student you try to enroll is already exist'],
        ]);

    }

    public function isLateEnroll($startDate)
    {
        $start = date_create($startDate);
        $studentStart = date_create($this->enrollDate);
        $studentdays = $start->diff($studentStart)->days;

        if ($start < $studentStart){
            return true;
        }
        else{
            return false;
        }
    }

    public function getPaymentExist(){
        $payments = 0;
        foreach ($this->invoices as $invoice) {
            $payments += count($invoice->invoicepayments);
        }
        if($payments > 0){
            return true;
        }else{
            return false;
        }
    }



    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if($this->isNewRecord){
            $student = Student::findOne($this->student_id);
            $this->academicYear_id = AcademicYear::find()->where(['active' => true])->one()->id;
            $this->paymentStatus_id = 19;
            if($this->discount_id == null){
                if($student->discount_id == null){
                    $this->discount_id = 1;
                }
                else{
                $this->discount_id = $student->discount_id;
                }
            }

            $setting = Setting::findOne(['code' => 'PRE-EN-CODE']);
            $parameter = '';

            if($setting->parameter1 != NULL){
                $parameter = $setting->analyzeParameter($setting->parameter1, $this->branch);
            }
            if($setting->parameter2 != NULL){
                $parameter .= $setting->analyzeParameter($setting->parameter2,  $this->branch);
            }
            if($setting->parameter3 != NULL){
                $parameter .= $setting->analyzeParameter($setting->parameter3,  $this->branch);
            }
            if($setting->parameter4 != NULL){
                $parameter4 = $setting->analyzeParameter($setting->parameter4);
            }else{
                $parameter4 = 5;
            }

            $year = date('Y');

            if( strpos( $parameter, $year ) == true ) {
                $number = Enrollment::find()->where(['like', 'enrollCode', $year])->count() + 1;
            }
            else{
                $number = Enrollment::find()->count() + 1;


            }
            $this->enrollCode = $parameter . sprintf('%0' . $parameter4 . 'd',$number);

        }
        else{

        }

        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
            // NEW ENROLLMENT ONLY AND UPDATED VALUE
            // DETERMINE IF UPDATED VALUE NEED TO WRITE THE WHOLE FEE
            $write = true;
            if(!$insert){
                if(!empty($changedAttributes)){
                    foreach(array_keys($changedAttributes) as $column){
                        if($column == 'paymentStatus_id'){
                            $test = Appendix::find()->andWhere(['test' => 'me'])->one();
                            $write = false; // ENROLLMENT UPDATE BECAUSE PAYMENT RECEIVED
                        }
                    }
                    if($write){
                        $enrollmentFees = EnrollmentFee::find()->andWhere(['enrollment_id' => $this->id])->all();
                        foreach($enrollmentFees as $enrollmentFee){
                            $enrollmentFee->deleteWithRelated();
                        }
                    }
                }
            }
            if($this->payTerm_id == 24){
                $payterm_id = 21;
            }else{
                $payterm_id = $this->payTerm_id;
            }
            if($write == true){
                /* Enrollment Fee */
                if(FeeCategory::find()->where(['description' => 'Enrollment'])->count() != 0){
                        $enrollCat = FeeCategory::find()->where(['description' => 'Enrollment'])->one();
                        $enrollmentFee = Fee::find()->where(['feeCategory_id' => $enrollCat->id])->one();

                        if(!empty($enrollmentFee)){
                            $enrollFee = new EnrollmentFee();
                            $enrollFee->fee_id = $enrollmentFee->id;
                            $enrollFee->amount = $enrollmentFee->amount;
                            if(!empty($this->discount->discountdetails)){
                                //INITIAL VALUE
                                $enrollFee->discount = 0;
                                $enrollFee->is_amount = false;
                                // FIND DISCOUNT
                                foreach($this->discount->discountdetails as $discountDetail){
                                    if($discountDetail->feeCategory->description == 'Enrollment'){
                                        $enrollFee->discount = $discountDetail->value;
                                        $enrollFee->is_amount = $discountDetail->isamount;
                                    }
                                }
                            }
                            else{
                                $enrollFee->discount = 0;
                                $enrollFee->is_amount = 0;
                            }
                            $enrollFee->lock = 0;
                            $enrollFee->link('enrollment', $this);
                        }
                    }
                    /* Admin Fee */
                if(FeeCategory::find()->where(['description' => 'Admin'])->count() != 0) {
                        $adminCat = FeeCategory::find()->where(['description' => 'Admin'])->one();
                        $adminFee = Fee::find()->where(['feeCategory_id' => $adminCat->id])
                            ->andFilterWhere(['feeType_id' => $payterm_id])->one();
                        if(!empty($adminFee)) {
                            $enrollFee = new EnrollmentFee();
                            $enrollFee->fee_id = $adminFee->id;
                            $enrollFee->amount = $adminFee->amount;
                            if(!empty($this->discount->discountdetails)){
                                //INITIAL VALUE
                                $enrollFee->discount = 0;
                                $enrollFee->is_amount = 0;
                                // FIND DISCOUNT
                                foreach($this->discount->discountdetails as $discountDetail){
                                    if($discountDetail->feeCategory->description == 'Admin'){
                                        $enrollFee->discount = $discountDetail->value;
                                        $enrollFee->is_amount = $discountDetail->isamount;
                                    }
                                }
                            }
                            else{
                                $enrollFee->discount = 0;
                                $enrollFee->is_amount = 0;
                            }
                            $enrollFee->lock = 0;
                            $enrollFee->link('enrollment', $this);
                        }
                    }
                    /* Tuition Fee */
                if(FeeCategory::find()->where(['description' => 'Tuition'])->count() != 0) {
                        $tuitionCat = FeeCategory::find()->where(['description' => 'Tuition'])->one();
                        $tuitionFee = Fee::find()->where(['feeCategory_id' => $tuitionCat->id])
                            ->andFilterWhere(['feeType_id' => $payterm_id])
                            ->andFilterWhere(['grade_id' => $this->grade_id])->one();

                        if(!empty($tuitionFee)) {
                            $enrollFee = new EnrollmentFee();
                            $enrollFee->fee_id = $tuitionFee->id;
                            $enrollFee->amount = $tuitionFee->amount;
                            if(!empty($this->discount->discountdetails)){
                                //INITIAL VALUE
                                $enrollFee->discount = 0;
                                $enrollFee->is_amount = false;
                                // FIND DISCOUNT
                                foreach($this->discount->discountdetails as $discountDetail){
                                    if($discountDetail->feeCategory->description == 'Tuition'){
                                        $enrollFee->discount = $discountDetail->value;
                                        $enrollFee->is_amount = $discountDetail->isamount;
                                    }
                                }
                            }
                            else{
                                $enrollFee->discount = 0;
                                $enrollFee->is_amount = false;
                            }
                            $enrollFee->lock = 0;
                            $discountGroupDetail = DiscountGroupDetail::find()->andWhere(['enrollment_id' => $this->id])->one();
                            if(!empty($discountGroupDetails)){
                                $countItem = DiscountGroupDetail::find()->andWhere(['discountgroup_id' => $discountGroupDetail->discountGroup_id])->count();
                                $discountGroupTypeDetails = $discountGroupDetail->discountGroup->discountGroupType->discountgrouptypedetails;
                                foreach ($discountGroupTypeDetails as $item){
                                    if($countItem >= $item->number_least){
                                        $enrollFee->discount = $item->discount;
                                        $enrollFee->is_amount = $item->isamount;
                                    }
                                }
                            }
                            $enrollFee->link('enrollment', $this);
                        }
                    }
                    /* Snack Fee */
                if(FeeCategory::find()->where(['description' => 'Snack'])->count() != 0) {
                            if($this->snack){
                            $snackCat = FeeCategory::find()->where(['description' => 'Snack'])->one();
                            $snackFee = Fee::find()->where(['feeCategory_id' => $snackCat->id])
                                ->andFilterWhere(['feeType_id' => $payterm_id])
                                ->andFilterWhere(['program_id' => $this->grade->program_id])
                                ->andFilterWhere(['scheduleType_id' => $this->scheduleType_id])->one();

                            if(!empty($snackFee)) {
                                $enrollFee = new EnrollmentFee();
                                $enrollFee->fee_id = $snackFee->id;
                                $enrollFee->amount = $snackFee->amount;
                                if(!empty($this->discount->discountdetails)){
                                    //INITIAL VALUE
                                    $enrollFee->discount = 0;
                                    $enrollFee->is_amount = false;
                                    // FIND DISCOUNT
                                    foreach($this->discount->discountdetails as $discountDetail){
                                        if($discountDetail->feeCategory->description == 'Snack'){
                                            $enrollFee->discount = $discountDetail->value;
                                            $enrollFee->is_amount = $discountDetail->isamount;
                                        }
                                    }
                                }
                                else{
                                    $enrollFee->discount = 0;
                                    $enrollFee->is_amount = false;
                                }
                                $enrollFee->lock = 0;
                                $enrollFee->link('enrollment', $this);
                            }
                            else{

                            }
                        }
                    }
                    /* Lunch Fee */
                if(FeeCategory::find()->where(['description' => 'Lunch'])->count() != 0) {
                        if($this->lunch) {
                            $lunchCat = FeeCategory::find()->where(['description' => 'Lunch'])->one();
                            $lunchFee = Fee::find()->where(['feeCategory_id' => $lunchCat->id])
                                ->andFilterWhere(['feeType_id' => $payterm_id])
        //                      ->andFilterWhere(['scheduleType_id' => $this->scheduleType_id]) // Lunch not depend on full or half
                                ->andFilterWhere(['program_id' => $this->grade->program_id])->one();

                            if(!empty($lunchFee)) {
                                $enrollFee = new EnrollmentFee();
                                $enrollFee->fee_id = $lunchFee->id;
                                $enrollFee->amount = $lunchFee->amount;
                                if(!empty($this->discount->discountdetails)){
                                    //INITIAL VALUE
                                    $enrollFee->discount = 0;
                                    $enrollFee->is_amount = false;
                                    // FIND DISCOUNT
                                    foreach($this->discount->discountdetails as $discountDetail){
                                        if($discountDetail->feeCategory->description == 'Lunch'){
                                            $enrollFee->discount = $discountDetail->value;
                                            $enrollFee->is_amount = $discountDetail->isamount;
                                        }
                                    }
                                }
                                else{
                                    $enrollFee->discount = 0;
                                    $enrollFee->is_amount = false;
                                }
                                $enrollFee->lock = 0;
                                $enrollFee->link('enrollment', $this);
                            }
                        }
                        else{

                        }
                    }
                    /* Learning Material */
                if(FeeCategory::find()->where(['description' => 'Learning Material'])->count() != 0) {
                        $materialCat = FeeCategory::find()->where(['description' => 'Learning Material'])->one();
                        $materialFee = Fee::find()->where(['feeCategory_id' => $materialCat->id])
                            ->andFilterWhere(['feeType_id' => $payterm_id])
                            ->andFilterWhere(['program_id' => $this->grade->program_id])->one();

                        if(!empty($materialFee)) {
                            $enrollFee = new EnrollmentFee();
                            $enrollFee->fee_id = $materialFee->id;
                            $enrollFee->amount = $materialFee->amount;
                            if(!empty($this->discount->discountdetails)){
                                //INITIAL VALUE
                                $enrollFee->discount = 0;
                                $enrollFee->is_amount = false;
                                // FIND DISCOUNT
                                foreach($this->discount->discountdetails as $discountDetail){
                                    if($discountDetail->feeCategory->description == 'Learning Material'){
                                        $enrollFee->discount = $discountDetail->value;
                                        $enrollFee->is_amount = $discountDetail->isamount;
                                    }
                                }
                            }
                            else{
                                $enrollFee->discount = 0;
                                $enrollFee->is_amount = false;
                            }
                            $enrollFee->lock = 0;
                            $enrollFee->link('enrollment', $this);
                        }
                    }
                    /* Uniform */
                if(FeeCategory::find()->where(['description' => 'Uniform'])->count() != 0) {
                        $uniformCat = FeeCategory::find()->where(['description' => 'Uniform'])->one();
                        $uniformFees = Fee::find()->where(['feeCategory_id' => $uniformCat->id])
                            ->andFilterWhere(['program_id' => $this->grade->program_id])->all();

                        if(!empty($uniformFees)) {
                            foreach($uniformFees as $uniformFee){
                                $enrollFee = new EnrollmentFee();
                                $enrollFee->fee_id = $uniformFee->id;
                                $enrollFee->amount = $uniformFee->amount;
                                if(!empty($this->discount->discountdetails)){
                                    //INITIAL VALUE
                                    $enrollFee->discount = 0;
                                    $enrollFee->is_amount = false;
                                    // FIND DISCOUNT
                                    foreach($this->discount->discountdetails as $discountDetail){
                                        if($discountDetail->feeCategory->description == 'Uniform'){
                                            $enrollFee->discount = $discountDetail->value;
                                            $enrollFee->is_amount = $discountDetail->isamount;
                                        }
                                    }
                                }
                                else{
                                    $enrollFee->discount = 0;
                                    $enrollFee->is_amount = false;
                                }
                                $enrollFee->lock = 0;
                                $enrollFee->link('enrollment', $this);
                            }
                        }
                    }
                    /* Van Service */
                if(Fee::find()->where(['like', 'description', $this->vanService->title])->count() != 0) {
                        $vanFee = Fee::find()->where(['like', 'description', $this->vanService->title])
                                    ->andFilterWhere(['feeType_id' => $payterm_id])->one();

                        $enrollFee = new EnrollmentFee();
                        $enrollFee->fee_id = $vanFee->id;
                        $enrollFee->amount = $vanFee->amount;
                        if(!empty($this->discount->discountdetails)){
                            //INITIAL VALUE
                            $enrollFee->discount = 0;
                            $enrollFee->is_amount = false;
                            // FIND DISCOUNT
                            foreach($this->discount->discountdetails as $discountDetail){
                                if($discountDetail->feeCategory->description == 'Van Service'){
                                    $enrollFee->discount = $discountDetail->value;
                                    $enrollFee->is_amount = $discountDetail->isamount;
                                }
                            }
                        }
                        else{
                            $enrollFee->discount = 0;
                            $enrollFee->is_amount = false;
                        }
                        $enrollFee->lock = 0;
                        $enrollFee->link('enrollment', $this);
                    }
                    // INVOICE GENERATOR //
                if($this->deleted_by == 0){
                    if($write){
                        $invoices = Invoice::find()->andWhere(['enrollment_id' => $this->id])->all();
                        foreach($invoices as $invoice){
                            $invoice->deleteWithRelated();
                        }
                    }
                        if($this->payTerm_id == 21){ //Pay by term
                            $semesters = $this->academicYear->semesters;
                            // Loop through academic year for semesters //
                            foreach($semesters as $semester){
                                $terms = $semester->terms;
                                $sequence = 1;
                                // Loop through semester for terms //
                                foreach($terms as $term){
                                    // Initial Insert Process (Start from first term of first semester) //
                                    $invoice = new Invoice();
                                    if($term->sequence == 1) {
                                        if ($this->isLateEnroll($term->startDate)) {
                                            $invoice->dueDate = date("Y-m-d", strtotime("+1 week", strtotime($this->enrollDate)));
                                        } else {
                                            $invoice->dueDate = date("Y-m-d", strtotime("+1 week", strtotime($term->startDate)));
                                        }
                                    }
                                    else{
                                        $invoice->dueDate = date("Y-m-d", strtotime("+1 week", strtotime($term->startDate)));
                                    }
                                    $invoice->lock = 0;
                                    $invoice->discount = 0; // NO DISCOUNT OPTION FOR NOW //
                                    $invoice->is_amount = 0; // NO DISCOUNT OPTION FOR NOW //
                                    $invoice->status_id = 19; // Initially the invoice is not paid, status is unpaid //
                                    $invoice->sequence = $sequence;
                                    $invoice->term_id = $term->id;
                                    $invoice->semester_id = $semester->id;
                                    $invoice->academicYear_id = $this->academicYear_id;
                                    $invoice->link('enrollment', $this);
                                    $sequence++;
                                }
                            }
                        }
                        elseif($this->payTerm_id == 22){
                            // Pay by semester //
                            $semesters = $this->academicYear->semesters;
                            $sequence = 1;
                            // Loop through academic year for semesters //
                            foreach($semesters as $semester){
                                // Initial Insert Process (Start from first semester) //
                                $invoice = new Invoice();
                                if($semester->sequence == 1){ // LATE ENROLL ONLY FIRST SEMESTER
                                    if ($this->isLateEnroll($semester->startDate)) {
                                        $invoice->dueDate = date("Y-m-d", strtotime("+1 week", strtotime($this->enrollDate)));
                                    } else {
                                        $invoice->dueDate = date("Y-m-d", strtotime("+1 week", strtotime($semester->startDate)));
                                    }
                                }
                                else{
                                    $invoice->dueDate = date("Y-m-d", strtotime("+1 week", strtotime($semester->startDate)));
                                }
                                $invoice->lock = 0;
                                $invoice->discount = 0; // NO DISCOUNT OPTION FOR NOW //
                                $invoice->is_amount = 0; // NO DISCOUNT OPTION FOR NOW //
                                $invoice->status_id = 19; // Initially the invoice is not paid, status is unpaid //
                                $invoice->sequence = $sequence;
                                $invoice->semester_id = $semester->id;
                                $invoice->academicYear_id = $this->academicYear_id;
                                $invoice->link('enrollment', $this);
                                $sequence++;
                            }
                        }
                        elseif($this->payTerm_id == 23){
                            $invoice = new Invoice();
                            // Pay by Year no semester or term needed //
                            if ($this->isLateEnroll($this->academicYear->startDate)) {
                                $invoice->dueDate = date("Y-m-d", strtotime("+1 week", strtotime($this->enrollDate)));
                            } else {
                                $invoice->dueDate = date("Y-m-d", strtotime("+1 week", strtotime($this->academicYear->startDate)));
                            }
                            $invoice->lock = 0;
                            $invoice->discount = 0; // NO DISCOUNT OPTION FOR NOW //
                            $invoice->is_amount = 0; // NO DISCOUNT OPTION FOR NOW //
                            $invoice->status_id = 19; // Initially the invoice is not paid, status is unpaid //
                            $invoice->sequence = 1;
                            $invoice->academicYear_id = $this->academicYear_id;
                            $invoice->link('enrollment', $this);
                        }
                        else{
                            // Pay by Monthly, generate invoice for number of month in a term include specific number of days //
                            $semesters = $this->academicYear->semesters;
                            // Loop through academic year for semesters //
                            foreach($semesters as $semester){
                                $terms = $semester->terms;
                                    // Loop through semester for terms //
                                    foreach($terms as $term){

                                        $start = date_create($term->startDate);
                                        $studentStart = date_create($this->enrollDate);
                                        $studentdays = $start->diff($studentStart)->days;

                                        $caseDays = 0 ; // If Student start later month than enrollDate
                                        // Initial Insert Process (Start from first term of first semester) //
                                        // COUNT MONTHS OF TERM GET DETAILS LIKE YEAR, MONTH AND DAYS OF SEMESTER TO CREATE A NUMBER OF INVOICE //
                                        $termMonthDays = $term->calculateMonthDays();
                                        $sequence = 1;
                                        $years = array_keys($termMonthDays);
                                        // Loop through year as term might crossover to next year //
                                        foreach($years as $year){
                                            $monthkeys = array_keys($termMonthDays[$year]);
                                            // Loop through all the month //
                                            foreach($monthkeys as $monthkey){
                                                $invoice = new Invoice();
                                                $invoice->lock = 0;
                                                $invoice->discount = 0; // NO DISCOUNT OPTION FOR NOW //
                                                $invoice->is_amount = 0; // NO DISCOUNT OPTION FOR NOW //
                                                $invoice->status_id = 19; // Initially the invoice is not paid, status is unpaid //
                                                $invoice->year = $year;
                                                $invoice->month = $monthkey;
                                                $invoice->term_id = $term->id;
                                                $invoice->semester_id = $semester->id;
                                                $invoice->academicYear_id = $this->academicYear_id;
                                                if($term->sequence == 1 && $sequence == 1){
                                                    if($termMonthDays[$year][$monthkey] > $studentdays){
                                                        // If start late but not cross month
                                                        $invoice->sequence = $sequence;
                                                        $invoice->days = $termMonthDays[$year][$monthkey] - $studentdays;
                                                        $invoice->dueDate = date("Y-m-d", strtotime("+1 week", strtotime($this->enrollDate)));
                                                        $invoice->link('enrollment', $this);
                                                    }else{
                                                        // If student start too late and cross month,
                                                        // this will result the days that will omit from next month
                                                        $caseDays = $studentdays - $termMonthDays[$year][$monthkey];
                                                    }
                                                }
                                                elseif($term->sequence == 1 && $sequence == 2 && $caseDays != 0){ // This is the second month
                                                    // We will have caseDays from above, and we have to reset sequence
                                                    $sequence = 1;
                                                    $invoice->sequence = $sequence;
                                                    $invoice->days = $termMonthDays[$year][$monthkey] - $caseDays;
                                                    $invoice->dueDate = date("Y-m-d", strtotime("+1 week", strtotime($this->enrollDate)));
                                                    $invoice->link('enrollment', $this);
                                                    // Reset caseDays
                                                    $caseDays = 0;
                                                }
                                                else{
                                                    // Prepare due date for new term
                                                    if($sequence == 1){
                                                        $dueDate = strtotime($term->startDate);
                                                        $invoice->dueDate = date("Y-m-d", strtotime("+1 week", $dueDate));
                                                    }else{
                                                        $dueDate = strtotime($invoice->year . '-' . $invoice->month . ' -01');
                                                        $invoice->dueDate = date("Y-m-d", strtotime("+1 week", $dueDate));
                                                    }
                                                    $invoice->sequence = $sequence;
                                                    $invoice->days = $termMonthDays[$year][$monthkey];
                                                    $invoice->link('enrollment', $this);
                                                }
                                                $sequence++;
                                            }
                                        }
                                    }
                            }
                        }
                    }
                else{

                    }
            }
            else{

            }
    }

}
