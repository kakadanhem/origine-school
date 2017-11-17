<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "student".
 *
 * @property integer $id
 * @property string $code
 * @property string $forenameEn
 * @property string $surnameEn
 * @property string $forenameKh
 * @property string $surnameKh
 * @property string $nickname
 * @property string $allFullname
 * @property string $fullname
 * @property integer $gender_id
 * @property string $birthdate
 * @property integer $nationality_id
 * @property integer $religion_id
 * @property integer $discount_id
 * @property string $passportNo
 * @property string $passportExpire
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $deleted_at
 * @property integer $deleted_by
 * @property integer $lock
 *
 * @property \app\models\Enrollment[] $enrollments
 * @property \app\models\Appendix $gender
 * @property \app\models\Discount $discount
 * @property \app\models\Country $nationality
 * @property \app\models\Appendix $religion
 * @property \app\models\Studentguardian[] $studentguardians
 */
class Student extends \yii\db\ActiveRecord
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
            'enrollments',
            'gender',
            'nationality',
            'religion',
            'studentguardians'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['forenameEn', 'surnameEn', 'forenameKh', 'surnameKh', 'gender_id', 'birthdate', 'nationality_id'], 'required'],
            [['gender_id', 'nationality_id', 'religion_id', 'created_by','discount_id', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['birthdate', 'passportExpire','code', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['forenameEn', 'surnameEn', 'forenameKh', 'surnameKh', 'nickname', 'passportNo'], 'string', 'max' => 50],
            [['code'], 'string', 'max' => 20],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
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
            'code' => 'Code',
            'forenameEn' => 'Forename',
            'surnameEn' => 'Surname',
            'forenameKh' => 'ឈ្មោះ',
            'surnameKh' => 'ត្រគូល',
            'nickname' => 'Nickname',
            'gender_id' => 'Gender',
            'birthdate' => 'Birthdate',
            'nationality_id' => 'Nationality',
            'religion_id' => 'Religion',
            'passportNo' => 'Passport No',
            'passportExpire' => 'Passport Expire',
            'discount_id' => 'Discount',
            'lock' => 'Lock',
        ];
    }


    public function getFullname()
    {
        return $this->forenameEn . ' ' . $this->surnameEn;
    }


    public function getAllFullname()
    {
        return $this->forenameEn . ' ' . $this->surnameEn . ' ( ' . $this->surnameKh . ' ' . $this->forenameKh . ' ) ';
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnrollments()
    {
        return $this->hasMany(\app\models\Enrollment::className(), ['student_id' => 'id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGender()
    {
        return $this->hasOne(\app\models\Appendix::className(), ['id' => 'gender_id']);
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
    public function getNationality()
    {
        return $this->hasOne(\app\models\Country::className(), ['id' => 'nationality_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReligion()
    {
        return $this->hasOne(\app\models\Appendix::className(), ['id' => 'religion_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentguardians()
    {
        return $this->hasMany(\app\models\Studentguardian::className(), ['student_id' => 'id']);
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
     * @return \app\models\StudentQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\StudentQuery(get_called_class());
        return $query->where(['student.deleted_by' => 0]);
    }
}
