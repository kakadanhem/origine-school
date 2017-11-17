<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "appendix".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $appendixCategory_id
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $deleted_at
 * @property integer $deleted_by
 * @property integer $lock
 *
 * @property \app\models\Appendixcategory $appendixCategory
 * @property \app\models\Enrollment[] $enrollments
 * @property \app\models\Enrollmentfee[] $enrollmentfees
 * @property \app\models\EnrollmentCurrentPaymentStatus[] $enrollmentcurrentpaymentstatus
 * @property \app\models\Schedule[] $schedules
 * @property \app\models\Staff[] $staff
 * @property \app\models\Student[] $students
 * @property \app\models\Teacher[] $teachers
 */
class Appendix extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    private $_rt_softdelete;
    private $_rt_softrestore;

    public $feetypes;
    public $discounttypes;
    public $paymentstatus;

    public $discountFactor;

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
            'appendixCategory',
            'enrollments',
            'enrollmentfees',
            'enrollmentcurrentpaymentstatus',
            'schedules',
            'staff',
            'students',
            'teachers'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['appendixCategory_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['title'], 'string', 'max' => 50],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'appendix';
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
            'title' => 'Title',
            'description' => 'Description',
            'appendixCategory_id' => 'Appendix Category ID',
            'lock' => 'Lock',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppendixCategory()
    {
        return $this->hasOne(\app\models\Appendixcategory::className(), ['id' => 'appendixCategory_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnrollments()
    {
        return $this->hasMany(\app\models\Enrollment::className(), ['enrollType_id' => 'id']);
    }

        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnrollmentcurrentpaymentstatus()
    {
        return $this->hasMany(\app\models\EnrollmentCurrentPaymentStatus::className(), ['status_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(\app\models\Schedule::className(), ['day_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasMany(\app\models\Staff::className(), ['gender_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(\app\models\Student::className(), ['religion_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachers()
    {
        return $this->hasMany(\app\models\Teacher::className(), ['gender_id' => 'id']);
    }

    public function getDiscountAmount($amount, $discount){

        if($this->id == 15){
            return $amount * $discount * 0.01;
        }
        else{
            return $discount;
        }
    }


    /* GETTING ARROW FOR DROPDOWN */

    public function getFeeTypes()
    {
        return \yii\helpers\ArrayHelper::map($this->find()->where(['appendixCategory_id'=>'7'])->orderBy('id')->asArray()->all(), 'id', 'title');
    }

    public function getDiscountTypes()
    {
        return \yii\helpers\ArrayHelper::map($this->find()->where(['appendixCategory_id'=>'5'])->orderBy('id')->asArray()->all(), 'id', 'title');
    }

    public function getPaymentStatus()
    {
        return \yii\helpers\ArrayHelper::map($this->find()->where(['appendixCategory_id'=>'6'])->orderBy('id')->asArray()->all(), 'id', 'title');
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
     * @return \app\models\AppendixQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\AppendixQuery(get_called_class());
        return $query->where(['appendix.deleted_by' => 0]);
    }
}
