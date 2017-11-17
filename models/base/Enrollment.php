<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "enrollment".
 *
 * @property integer $id
 * @property integer $student_id
 * @property integer $grade_id
 * @property integer $branch_id
 * @property string $enrollDate
 * @property integer $enrollType_id
 * @property integer $payTerm_id
 * @property integer $academicYear_id
 * @property double $totalDiscount
 * @property double $amount
 * @property double $totalFee
 * @property double $discountedAmount
 * @property integer $discount_id
 * @property string $note
 * @property integer $paymentStatus_id
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $deleted_at
 * @property integer $deleted_by
 * @property integer $lock
 * @property string $title
 * @property string $enrollCode
 * @property boolean $snack
 * @property boolean $lunch
 * @property integer $vanService_id
 * @property integer $scheduleType_id
 *
 * @property \app\models\Appendix $enrollType
 * @property \app\models\Discount $discount
 * @property \app\models\Appendix $payTerm
 * @property \app\models\Appendix $scheduleType
 * @property \app\models\Appendix $vanService
 * @property \app\models\Appendix $paymentStatus
 * @property \app\models\Grade $grade
 * @property \app\models\Branch $branch
 * @property \app\models\Student $student
 * @property \app\models\DiscountGroupDetail $discountGroupDetail
 * @property \app\models\AcademicYear $academicYear
 * @property \app\models\EnrollmentFee[] $enrollmentFees
 * @property \app\models\Invoice[] $invoices
 */
class Enrollment extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    private $_rt_softdelete;
    private $_rt_softrestore;

    public $searchprogram_id;
    public $searchpaymentstatus_id;

    public function __construct(){
        parent::__construct();
        $this->_rt_softdelete = [
            'deleted_by' => \Yii::$app->user->id,
            'deleted_at' => date('Y-m-d H:i:s'),
        ];
        $this->_rt_softrestore = [
            'deleted_by' => 0,
            'deleted_at' => date('Y-m-d H:i:s'),
        ];
    }

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'enrollType',
            'discount',
            'payTerm',
            'grade',
            'branch',
            'student',
            'enrollmentFees',
            'paymentStatus',
            'academicYear',
            'invoices',
            'scheduleType',
            'discountGroupDetails',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['paymentStatus_id','vanService_id','academicYear_id','scheduleType_id','searchprgoram_id','student_id', 'grade_id','payTerm_id','branch_id', 'enrollType_id', 'discount_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['enrollCode','title','enrollDate', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['snack', 'lunch'], 'boolean'],
            [['note'], 'string'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'enrollment';
    }

    /**
     *
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock
     *
     */
    public function optimisticLock() {
        return 'lock';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student',
            'grade_id' => 'Grade',
            'branch_id' => 'Branch',
            'enrollDate' => 'Enroll Date',
            'enrollType_id' => 'Enroll Type',
            'payTerm_id' => 'Pay Term',
            'discount' => 'Discount',
            'discount_id' => 'Discount',
            'scheduleType_id' => 'Schedule Type',
            'vanService_id' => 'Van Service',
            'lock' => 'Lock',
            'note' => 'Note',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscountGroupDetails()
    {
        return $this->hasOne(\app\models\DiscountGroupDetail::className(), ['enrollment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(\app\models\Invoice::className(), ['enrollment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVanService()
    {
        return $this->hasOne(\app\models\Appendix::className(), ['id' => 'vanService_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnrollType()
    {
        return $this->hasOne(\app\models\Appendix::className(), ['id' => 'enrollType_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScheduleType()
    {
        return $this->hasOne(\app\models\Appendix::className(), ['id' => 'scheduleType_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentStatus()
    {
        return $this->hasOne(\app\models\Appendix::className(), ['id' => 'paymentStatus_id']);
    }


    public function getTitle()
    {
        return $this->grade->description . " - " . $this->student->forenameEn . " " . $this->student->surnameEn;
    }

    public function getPaidAmount()
    {
        if($this->paymentStatus == null){
            return 0;
        }
        else{
            return 999;
        }
    }


    public function getDiscountedAmount()
    {
        $amount = 0.0;
        $fees = $this->enrollmentFees;
         foreach($fees as $fee){
                $amount += $fee->discountedAmount;
         }
        return $amount;
    }

    public function getAmount()
    {
        $amount = 0.0;
        $fees = $this->enrollmentFees;
        foreach($fees as $fee){
            $amount += $fee->amount;
        }
        return $amount;
    }

    public function getTotalDiscount()
    {
        $discount = 0.0;
        $fees = $this->enrollmentFees;
        foreach($fees as $fee){
            $discount += $fee->totalDiscount;
        }
        return $discount;
    }

    public function getTotalFee()
    {
        $totalFee = 0;
        foreach($this->invoices as $invoice){
            $totalFee += $invoice->getFinalAmountAfterDiscount();
        }
        return $totalFee;
    }
    /**
     * @return integer
     */
    public function getSearchPaymentStatus_id()
    {
        return $this->searchpaymentstatus_id;
    }

    public function setSearchPaymentStatus_id($searchPaymentStatus_id)
    {
        $this->searchpaymentstatus_id = $searchPaymentStatus_id;
    }

    /**
     * @return integer
     */
    public function getSearchPrgoram_id()
    {
        return $this->searchprogram_id;
    }

    public function setSearchPrgoram_id($searchProgram_id)
    {
        $this->searchprogram_id = $searchProgram_id;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscount()
    {
        return $this->hasOne(\app\models\Discount::className(), ['id' => 'discount_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayTerm()
    {
        return $this->hasOne(\app\models\Appendix::className(), ['id' => 'payTerm_id']);
    }
        
    /**
 * @return \yii\db\ActiveQuery
 */
    public function getGrade()
    {
        return $this->hasOne(\app\models\Grade::className(), ['id' => 'grade_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(\app\models\Branch::className(), ['id' => 'branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcademicYear()
    {
        return $this->hasOne(\app\models\AcademicYear::className(), ['id' => 'academicYear_id']);
    }

    /**
     * @return string
     */
    public function  getStudentName($id){
        $completeStudentName = \app\models\Student::findOne($id)->forenameEn . ' ' .
            \app\models\Student::findOne($id)->surnameEn . ' ( ' .
            \app\models\Student::findOne($id)->surnameKh . ' ' .
            \app\models\Student::findOne($id)->forenameKh . ' ) ';
        return $completeStudentName;
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(\app\models\Student::className(), ['id' => 'student_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnrollmentFees()
    {
        return $this->hasMany(\app\models\EnrollmentFee::className(), ['enrollment_id' => 'id']);
    }


    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * The following code shows how to apply a default condition for all queries:
     *
     * ```php
     * class Customer extends ActiveRecord
     * {
     *     public static function find()
     *     {
     *         return parent::find()->where(['deleted' => false]);
     *     }
     * }
     *
     * // Use andWhere()/orWhere() to apply the default condition
     * // SELECT FROM customer WHERE `deleted`=:deleted AND age>30
     * $customers = Customer::find()->andWhere('age>30')->all();
     *
     * // Use where() to ignore the default condition
     * // SELECT FROM customer WHERE age>30
     * $customers = Customer::find()->where('age>30')->all();
     * ```
     */

    /**
     * @inheritdoc
     * @return \app\models\EnrollmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\EnrollmentQuery(get_called_class());
        return $query->where(['enrollment.deleted_by' => 0]);
    }
}
