<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "fee".
 *
 * @property integer $id
 * @property string $description
 * @property double $amount
 * @property integer $grade_id
 * @property integer $feeCategory_id
 * @property integer $feeType_id
 * @property integer $program_id
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $deleted_at
 * @property integer $deleted_by
 * @property integer $lock
 *
 * @property \app\models\Enrollmentfee[] $enrollmentfees
 * @property \app\models\Feecategory $feeCategory
 * @property \app\models\Appendix $feeType
 * @property \app\models\Grade $grade
 * @property \app\models\Appendix $scheduleType
 * @property \app\models\Program $program
 * @property \app\models\Feegrouping[] $feegroupings
 */
class Fee extends \yii\db\ActiveRecord
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
            'enrollmentfees',
            'feeCategory',
            'feegroupings',
            'feeType',
            'grade',
            'scheduleType',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amount'], 'number'],
            [['program_id','grade_id','feeCategory_id', 'feeType_id','scheduleType_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['description'], 'string', 'max' => 50],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fee';
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
            'description' => 'Description',
            'amount' => 'Amount',
            'feeCategory_id' => 'Fee Category ID',
            'feeType_id' => 'Fee Type',
            'grade_id' => 'Grade',
            'scheduleType_id' => 'Schedule',
            'program_id' => 'Program',
            'lock' => 'Lock',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnrollmentfees()
    {
        return $this->hasMany(\app\models\Enrollmentfee::className(), ['fee_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeeCategory()
    {
        return $this->hasOne(\app\models\Feecategory::className(), ['id' => 'feeCategory_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeeType()
    {
        return $this->hasOne(\app\models\Appendix::className(), ['id' => 'feeType_id']);
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
    public function getScheduleType()
    {
        return $this->hasOne(\app\models\Appendix::className(), ['id' => 'scheduleType_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgram()
    {
        return $this->hasOne(\app\models\Program::className(), ['id' => 'program_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeegroupings()
    {
        return $this->hasMany(\app\models\Feegrouping::className(), ['fee_id' => 'id']);
    }

    public function getTotalFee($enrollment_id)
    {
        $totalfee = 0;
        if(\app\models\EnrollmentFee::find()->where(['enrollment_id'=> $enrollment_id])->count() ==0) {
        }
        else {
            $enrollmentfees = \app\models\EnrollmentFee::find()->where(['enrollment_id'=> $enrollment_id])->all();
            foreach ($enrollmentfees as $enrollmentfee){
                $totalfee += $enrollmentfee->getDiscountedAmount();
            }
        }
        return $totalfee;
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
     * @return \app\models\FeeQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\FeeQuery(get_called_class());
        return $query->where(['fee.deleted_by' => 0]);
    }
}
