<?php

namespace app\models\base;

use app\modules\academic\EnrollmentTool\EnrollmentTool;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "enrollmentfee".
 *
 * @property integer $id
 * @property integer $enrollment_id
 * @property integer $fee_id
 * @property double $amount
 * @property double $discount
 * @property double $discountedAmount
 * @property double $totalDiscount
 * @property integer $is_amount
 * @property integer $status_id
 * @property string $dueDate
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $deleted_at
 * @property integer $deleted_by
 * @property integer $lock
 *
 * @property \app\models\Appendix $discountType
 * @property \app\models\Appendix $status
 * @property \app\models\Enrollment $enrollment
 * @property \app\models\Fee $fee
 */
class EnrollmentFee extends \yii\db\ActiveRecord
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
            'fee',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['enrollment_id', 'fee_id', 'is_amount','status_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['amount', 'discount'], 'number'],
            [['created_at', 'updated_at', 'deleted_at', 'dueDate'], 'safe'],
            [['lock','discount'], 'default', 'value' => '0'],
            [['is_amount'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'enrollmentfee';
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
            'id' => Yii::t('app','ID'),
            'enrollment_id' => Yii::t('app','Enrollment'),
            'fee_id' => Yii::t('app','Enrollment'),
            'amount' => Yii::t('app','Amount'),
            'discount' => Yii::t('app','Discount'),
            'is_amount' => Yii::t('app','In Amount'),
            'status_id' => Yii::t('app','Status'),
            'dueDate' => Yii::t('app','Due Date'),
            'lock' => Yii::t('app','Lock'),
        ];
    }


    public function getTotalDiscount()
    {
        $discount = 0.0;
        if($this->is_amount == false){
            $discount += $this->discount;
        }
        else{
            $discount += ($this->amount * $this->discount / 100);
        }
        return $discount;
    }

    public function getDiscountedAmount()
    {
        return $this->amount - $this->totalDiscount;
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
    public function getFee()
    {
        return $this->hasOne(\app\models\Fee::className(), ['id' => 'fee_id']);
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
     * @return \app\models\EnrollmentFeeQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\EnrollmentFeeQuery(get_called_class());
        return $query->where(['enrollmentfee.deleted_by' => 0]);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->amount = $this->fee->amount;
        return true;
    }


}
