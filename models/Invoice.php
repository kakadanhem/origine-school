<?php

namespace app\models;

use function GuzzleHttp\Psr7\str;
use Yii;
use \app\models\base\Invoice as BaseInvoice;

/**
 * This is the model class for table "invoice".
 */
class Invoice extends BaseInvoice
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['enrollment_id', 'is_amount', 'status_id', 'created_by', 'updated_by', 'deleted_by', 'lock', 'sequence'], 'integer'],
            [['year','month','days'], 'integer'],
            [['discount'], 'number'],
            [['dueDate', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['invoiceNo'], 'string', 'max' => 50],
            [['lock'], 'default', 'value' => '0'],
            [['status_id'], 'default', 'value' => 19],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }



    public function getEnrollDaysForCalculate($startDate, $enrollDate, $totaldays)
    {
        $start = date_create($startDate);
        $studentStart = date_create($enrollDate);
        $days = $start->diff($studentStart)->days;

        if ($studentStart <= $start){
            return $totaldays;
        }
        else{
            return $totaldays - $days;
        }
    }

    // FRONT DESK AMOUNT
    // ********************************************* //
    // Amount by Month (with late enroll calculated)
    /* get fee per Month to generate exact fee */

    public function getAmountByWeeksPerMonth($term_id, Enrollment $enrollment, Fee $fee){
        $term = Term::findOne($term_id);
        $termStart = date_create($term->startDate);
        $studentStart = date_create($enrollment->enrollDate);

        $monthCount = $term->getMonths();

        $weekLate = floor($termStart->diff($studentStart)->days / 7);
        $monthDiff = (date('m', strtotime($enrollment->enrollDate)) - date('m', strtotime($term->startDate))) +
        ((date('Y', strtotime($enrollment->enrollDate)) - date('Y', strtotime($term->startDate))) * 12);

        $monthCount = $monthCount - $monthDiff;

        if($fee->feeCategory->billPerDay){
        $finalFee = $fee->amount - (Yii::$app->formatter->asDecimal($fee->amount / 11,2) * $weekLate);
        }
        else{
            $finalFee = $fee->amount;
        }

        return $finalFee / $monthCount;
    }

    // Amount by Week (with late enroll calculated)
    public function getAmountByWeeksPerTerm($term_id, $enroll_id, $fee_id)
    {
        $term = Term::findOne($term_id);
        $enrollment = Enrollment::findOne($enroll_id);
        $fee = Fee::findOne($fee_id);

        $termStart = date_create($term->startDate);
        $studentStart = date_create($enrollment->enrollDate);
        $weekLate = floor($termStart->diff($studentStart)->days / 7);

        if ($studentStart <= $termStart){
            return $fee->amount;
        }
        else{
            return $fee->amount - (($fee->amount / 11) * $weekLate);
        }
    }

    // Amount by Semester (with late enroll calculated)
    public function getAmountByWeeksPerSemester($semester_id, $enroll_id, $fee_id)
    {
        $semester = Semester::findOne($semester_id);
        $enrollment = Enrollment::findOne($enroll_id);
        $fee = Fee::findOne($fee_id);

        $termStart = date_create($semester->startDate);
        $studentStart = date_create($enrollment->enrollDate);
        $weekLate = floor($termStart->diff($studentStart)->days / 7);

        if ($studentStart <= $termStart){
            return $fee->amount;
        }
        else{
            return $fee->amount - (($fee->amount / 22) * $weekLate);
        }
    }

    // Amount by Year (with late enroll calculated)
    public function getAmountByWeeksPerYear($year_id, $enroll_id, $fee_id)
    {
        $year = AcademicYear::findOne($year_id);
        $enrollment = Enrollment::findOne($enroll_id);
        $fee = Fee::findOne($fee_id);

        $termStart = date_create($year->startDate);
        $studentStart = date_create($enrollment->enrollDate);
        $weekLate = floor($termStart->diff($studentStart)->days / 7);

        if ($studentStart <= $termStart){
            return $fee->amount;
        }
        else{
            return $fee->amount - (($fee->amount / 44) * $weekLate);
        }
    }

    // FINANCE AMOUNT PER DAY
    // *******************************************************************************//
    /* get fee per term */
    public function getAmountByDaysPerMonth($term_id, Enrollment $enrollment, Fee $fee)
    {
        $term = Term::findOne($term_id);
        $termStart = date_create($term->startDate);
        $studentStart = date_create($enrollment->enrollDate);

        $monthCount = $term->getMonths();

        $dayLate = $termStart->diff($studentStart)->days;
        $monthDiff = (date('m', strtotime($enrollment->enrollDate)) - date('m', strtotime($term->startDate))) +
                ((date('Y', strtotime($enrollment->enrollDate)) - date('Y', strtotime($term->startDate))) * 12);

        // IF later than 1 month then 1 month is gone from equation
        $monthCount = $monthCount - $monthDiff;

        // Original fee minus Total fee of late days
        if($fee->feeCategory->billPerDay){
        $finalFee = $fee->amount - (Yii::$app->formatter->asDecimal($fee->amount / $term->days,2) * $dayLate);
        }
        else{
        $finalFee = $fee->amount;
        }
        // Final fee that minus late ones, divide to months
        return $finalFee / $monthCount;
    }

    /* get fee per term */
    public function getAmountByDaysPerTerm($term_id, Enrollment $enroll, Fee $fee){

        $term = Term::findOne($term_id);
        $termStart = date_create($term->startDate);
        $studentStart = date_create($enroll->enrollDate);
        $dayLate = $termStart->diff($studentStart)->days;

        if ($studentStart <= $termStart){
            return $fee->amount;
        }
        else{
            return $fee->amount - (($fee->amount / $term->days) * $dayLate);
        }
    }

    /* Get fee per Semester (by Day) */
    public function getAmountByDaysPerSemester($semester_id, Enrollment $enroll, Fee $fee){

        $semester = Semester::findOne($semester_id);
        $termStart = date_create($semester->startDate);
        $studentStart = date_create($enroll->enrollDate);
        $dayLate = $termStart->diff($studentStart)->days;

        if ($studentStart <= $termStart){
            return $fee->amount;
        }
        else{
            return $fee->amount - (($fee->amount / $semester->days) * $dayLate);
        }
    }


    /* Calculate fer per Year by Day */
    public function getAmountByDaysPerYear($year_id, Enrollment $enroll , Fee $fee){

        $year = AcademicYear::findOne($year_id);
        $termStart = date_create($year->startDate);
        $studentStart = date_create($enroll->enrollDate);
        $dayLate = $termStart->diff($studentStart)->days;

        if ($studentStart <= $termStart){
            return $fee->amount;
        }
        else{
            return $fee->amount - (($fee->amount / $year->days) * $dayLate);
        }
    }


    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            // SETTING INVOICE NO //

            $setting = Setting::findOne(['code' => 'PRE-INV-CODE']);
            $parameter = '';

            if($setting->parameter1 != NULL){
                $parameter = $setting->analyzeParameter($setting->parameter1, $this->enrollment->branch);
            }
            if($setting->parameter2 != NULL){
                $parameter .= $setting->analyzeParameter($setting->parameter2,  $this->enrollment->branch);
            }
            if($setting->parameter3 != NULL){
                $parameter .= $setting->analyzeParameter($setting->parameter3,  $this->enrollment->branch);
            }
            if($setting->parameter4 != NULL){
                $parameter4 = $setting->analyzeParameter($setting->parameter4);
            }else{
                $parameter4 = 5;
            }

            $year = date('Y');

            if( strpos( $parameter, $year ) == true ) {
                $number = Invoice::find()->andWhere(['like', 'invoiceNo', $year])->count() + 1;
            }
            else{
                $number = Invoice::find()->count() + 1;
            }
            $this->invoiceNo = $parameter . sprintf('%0' . $parameter4 . 'd',$number);

            //=================================================================//
        }

        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if(count($this->enrollment->enrollmentFees) == 0){
        }
        // GENERATE INVOICE ITEM FOR FINANCE (INTERNAL INVOICE) & FRONT DESK (FRONT INVOICE)
        else{
                $initInvoiceItems = InvoiceItem::find()->andWhere(['invoice_id' => $this->id])->all();
                foreach($initInvoiceItems as $initInvoiceItem){
                    $initInvoiceItem->deleteWithRelated();
                }
                if($this->enrollment->payTerm_id == 21){ //Pay by term
                    if($this->term->sequence == 1){ // First Term, All Fee
                        foreach ($this->enrollment->enrollmentFees as $fee){
                            if($fee->fee->feeCategory->billPerDay){
                                $invoiceItem = new InvoiceItem();
                                $invoiceItem->invoice_id = $this->id;
                                $invoiceItem->fee_id = $fee->fee_id;
                                $invoiceItem->amount = $this->getAmountByWeeksPerTerm(
                                  $this->term_id,
                                  $this->enrollment_id,
                                  $fee->fee_id
                                );
                                $invoiceItem->fin_amount = $this->getAmountByDaysPerTerm(
                                  $this->term_id,
                                  $this->enrollment,
                                  $fee->fee
                                );
                                $invoiceItem->discount = $fee->discount;
                                $invoiceItem->is_amount = $fee->is_amount;
                                $invoiceItem->saveAll();
                            }
                            else{
                                $invoiceItem = new InvoiceItem();
                                $invoiceItem->invoice_id = $this->id;
                                $invoiceItem->fee_id = $fee->fee_id;
                                $invoiceItem->amount = $fee->amount;
                                $invoiceItem->fin_amount = $fee->amount;
                                $invoiceItem->discount = $fee->discount;
                                $invoiceItem->is_amount = $fee->is_amount;
                                $invoiceItem->saveAll();
                            }
                        }
                    }
                    else{ // Second Term and later only Per Term Fees
                        foreach ($this->enrollment->enrollmentFees as $fee){
                            if($fee->fee->feeType_id == 21){ // Re-occuring fee only and also no billable per cycle
                                    $invoiceItem = new InvoiceItem();
                                    $invoiceItem->invoice_id = $this->id;
                                    $invoiceItem->fee_id = $fee->fee_id;
                                    $invoiceItem->amount = $fee->amount;
                                    $invoiceItem->fin_amount = $fee->amount;
                                    $invoiceItem->discount = $fee->discount;
                                    $invoiceItem->is_amount = $fee->is_amount;
                                    $invoiceItem->saveAll();

                            }
                        }
                    }
                }
                elseif ($this->enrollment->payTerm_id == 22){ // Pay By Semester
                    if($this->semester->sequence == 1){ // First Semester all Fee
                        foreach ($this->enrollment->enrollmentFees as $fee){
                            if($fee->fee->feeCategory->billPerDay){ // LATE ENROLL IF EXIST
                                $invoiceItem = new InvoiceItem();
                                $invoiceItem->invoice_id = $this->id;
                                $invoiceItem->fee_id = $fee->fee_id;
                                $invoiceItem->amount = $this->getAmountByWeeksPerSemester(
                                    $this->semester_id,
                                    $this->enrollment_id,
                                    $fee->fee_id
                                );
                                $invoiceItem->fin_amount = $this->getAmountByDaysPerSemester(
                                    $this->semester_id,
                                    $this->enrollment,
                                    $fee->fee
                                );
                                $invoiceItem->discount = $fee->discount;
                                $invoiceItem->is_amount = $fee->is_amount;
                                $invoiceItem->saveAll();
                            }
                            else{
                                $invoiceItem = new InvoiceItem();
                                $invoiceItem->invoice_id = $this->id;
                                $invoiceItem->fee_id = $fee->fee_id;
                                $invoiceItem->amount = $fee->amount;
                                $invoiceItem->fin_amount = $fee->amount;
                                $invoiceItem->discount = $fee->discount;
                                $invoiceItem->is_amount = $fee->is_amount;
                                $invoiceItem->saveAll();
                            }
                        }
                    }
                    else{ // Second Semester only Fee per Semester
                        foreach ($this->enrollment->enrollmentFees as $fee){
                            if($fee->fee->feeType_id == 22){ // IF Fee is re-ocurring
                                    $invoiceItem = new InvoiceItem();
                                    $invoiceItem->invoice_id = $this->id;
                                    $invoiceItem->fee_id = $fee->fee_id;
                                    $invoiceItem->amount = $fee->amount;
                                    $invoiceItem->fin_amount = $fee->amount;
                                    $invoiceItem->discount = $fee->discount;
                                    $invoiceItem->is_amount = $fee->is_amount;
                                    $invoiceItem->saveAll();
                            }
                        }
                    }

                }
                elseif ($this->enrollment->payTerm_id == 23){ // Pay Per Year
                    foreach ($this->enrollment->enrollmentFees as $fee){
                        if($fee->fee->feeCategory->billPerDay){
                            $invoiceItem = new InvoiceItem();
                            $invoiceItem->invoice_id = $this->id;
                            $invoiceItem->fee_id = $fee->fee_id;
                            $invoiceItem->amount = $this->getAmountByWeeksPerYear(
                                $this->academicYear_id,
                                $this->enrollment_id,
                                $fee->fee_id
                            );
                            $invoiceItem->fin_amount = $this->getAmountByDaysPerYear(
                                $this->academicYear_id,
                                $this->enrollment,
                                $fee->fee
                            );
                            $invoiceItem->discount = $fee->discount;
                            $invoiceItem->is_amount = $fee->is_amount;
                            $invoiceItem->saveAll();
                        }
                        else{
                            $invoiceItem = new InvoiceItem();
                            $invoiceItem->invoice_id = $this->id;
                            $invoiceItem->fee_id = $fee->fee_id;
                            $invoiceItem->amount = $fee->amount;
                            $invoiceItem->fin_amount = $fee->amount;
                            $invoiceItem->discount = $fee->discount;
                            $invoiceItem->is_amount = $fee->is_amount;
                            $invoiceItem->saveAll();
                        }
                    }
                }
                else{ // Pay by Monthly Fee Based on Term Fee
                    if($this->term->sequence == 1){ // First Term, All Fee
                            foreach ($this->enrollment->enrollmentFees as $fee){
                                    $invoiceItem = new InvoiceItem();
                                    $invoiceItem->invoice_id = $this->id;
                                    $invoiceItem->fee_id = $fee->fee_id;
                                    $invoiceItem->amount = $this->getAmountByWeeksPerMonth(
                                        $this->term_id,
                                        $this->enrollment,
                                        $fee->fee
                                    );
                                    $invoiceItem->fin_amount = $this->getAmountByDaysPerMonth(
                                        $this->term_id,
                                        $this->enrollment,
                                        $fee->fee
                                    );
                                    $invoiceItem->discount = $fee->discount;
                                    $invoiceItem->is_amount = $fee->is_amount;
                                    $invoiceItem->save();
                            }
                    }
                    else{ // later invoice only Per Term Fees
                        foreach ($this->enrollment->enrollmentFees as $fee){
                            if($fee->fee->feeType_id == 21){
                                // ONLY RE-OCURRING FEE
                                $invoiceItem = new InvoiceItem();
                                $invoiceItem->invoice_id = $this->id;
                                $invoiceItem->fee_id = $fee->fee_id;
                                // ALWAYS NOT LATE SO IT ALWAYS RETURN FULL AMOUNT
                                $invoiceItem->amount = $fee->amount / $this->term->getMonths();
                                $invoiceItem->fin_amount = $fee->amount / $this->term->getMonths();
                                $invoiceItem->discount = $fee->discount;
                                $invoiceItem->is_amount = $fee->is_amount;
                                $invoiceItem->save();
                            }
                        }
                    }
                }
        }

    }
	
}
