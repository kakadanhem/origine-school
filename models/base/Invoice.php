<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "invoice".
 *
 * @property integer $id
 * @property string $invoiceNo
 * @property integer $enrollment_id
 * @property double $discount
 * @property integer $is_amount
 * @property integer $status_id
 * @property integer $term_id
 * @property integer $semester_id
 * @property integer $academicYear_id
 * @property integer $sequence
 * @property integer $year
 * @property integer $month
 * @property integer $days
 * @property string $dueDate
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $deleted_at
 * @property integer $deleted_by
 * @property integer $lock
 *
 * @property double $totalAmount
 * @property double $totalDiscount
 * @property double $totalAmountAfterDiscount
 * @property double $finalDiscount
 * @property double $finalAmountAfterDiscount
 * @property double $paidAmount
 *
 * @property \app\models\Appendix $discountType
 * @property \app\models\Enrollment $enrollment
 * @property \app\models\Appendix $status
 * @property \app\models\Term $term
 * @property \app\models\Semester $semester
 * @property \app\models\AcademicYear $academicYear
 * @property \app\models\Invoiceitem[] $invoiceitems
 * @property \app\models\Invoicepayment[] $invoicepayments
 * @property \app\models\Receipt[] $receipts
 */
class Invoice extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    private $_rt_softdelete;
    private $_rt_softrestore;


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
            'enrollment',
            'status',
            'invoiceitems',
            'invoicepayments',
            'receipts'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['enrollment_id','term_id','semester_id','academicYear_id', 'is_amount', 'status_id', 'created_by', 'updated_by', 'deleted_by', 'lock', 'sequence'], 'integer'],
            [['year','month','days'], 'integer'],
            [['discount'], 'number'],
            [['dueDate', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['invoiceNo'], 'string', 'max' => 50],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice';
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
            'id' => Yii::t('app', 'ID'),
            'invoiceNo' => Yii::t('app', 'Invoice No'),
            'enrollment_id' => Yii::t('app', 'Enrollment'),
            'discount' => Yii::t('app', 'Discount'),
            'is_amount' => Yii::t('app', 'In Amount'),
            'status_id' => Yii::t('app', 'Status'),
            'dueDate' => Yii::t('app', 'Due Date'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerm()
    {
        return $this->hasOne(\app\models\Term::className(), ['id' => 'term_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSemester()
    {
        return $this->hasOne(\app\models\Semester::className(), ['id' => 'semester_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcademicYear()
    {
        return $this->hasOne(\app\models\AcademicYear::className(), ['id' => 'academicYear_id']);
    }

        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnrollment()
    {
        return $this->hasOne(\app\models\Enrollment::className(), ['id' => 'enrollment_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(\app\models\Appendix::className(), ['id' => 'status_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceitems()
    {
        return $this->hasMany(\app\models\Invoiceitem::className(), ['invoice_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoicepayments()
    {
        return $this->hasMany(\app\models\Invoicepayment::className(), ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceipts()
    {
        return $this->hasMany(\app\models\Invoicepayment::className(), ['invoice_id' => 'id']);
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

    public function getPaidAmount()
    {
        $paidAmount = 0.0;
        if($this->invoicepayments == null){
            return $paidAmount;
        }
        else{
            foreach($this->invoicepayments as $payment){
                $paidAmount += $payment->amount;
            }
        }
        return $paidAmount;
    }

    public function getTotalAmount()
    {
        $amount = 0.0;
        if($this->invoiceitems == null){
        }
        else{
            foreach($this->invoiceitems as $invoiceItem){
                $amount += $invoiceItem->amount;
            }
        }
        return $amount;
    }

    public function getTotalDiscount()
    {
        $totalDiscount = 0.0;
        $discount = 0.0;
        if($this->invoiceitems == null){

        }
        else{
            foreach($this->invoiceitems as $invoiceItem){
                    if($invoiceItem->is_amount){
                        $discount = $this->discount;
                    }
                    else{
                        $discount = $invoiceItem->amount * $invoiceItem->discount / 100;
                    }
                    $totalDiscount += $discount;
            }
        }

        return $totalDiscount;
    }

    public function getTotalAmountAfterDiscount()
    {
        return ($this->totalAmount - $this->totalDiscount);
    }

    public function getFinalAmountAfterDiscount(){
        return $this->totalAmountAfterDiscount; // NO INVOICE DISCOUNT
    }

    /**
 * @return float
 */
    public function getFinalDiscount()
    {
        return $this->totalDiscount;  // NO INVOICE DISCOUNT
    }

    public function getTotalFee()
    {
        $totalFee = 0;
        if($this->enrollmentFees == null){
        }
        else{

            foreach($this->enrollmentFees as $fee){
                $totalFee += $fee->getDiscountedAmount();
            }
        }
        return $totalFee;
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
     * @return \app\models\InvoiceQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\InvoiceQuery(get_called_class());
        return $query->where(['invoice.deleted_by' => 0]);
    }

}
