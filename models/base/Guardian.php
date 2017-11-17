<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "guardian".
 *
 * @property integer $id
 * @property string $code
 * @property string $forename
 * @property string $surname
 * @property string $fullname
 * @property integer $gender_id
 * @property string $streetAddress
 * @property integer $province_id
 * @property integer $district_id
 * @property integer $commune_id
 * @property integer $village_id
 * @property string $email
 * @property string $mobile
 * @property integer $workplace
 * @property string $position
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $deleted_at
 * @property integer $deleted_by
 * @property integer $lock
 * @property string $completeAddress
 *
 * @property \app\models\Commune $commune
 * @property \app\models\District $district
 * @property \app\models\Appendix $gender
 * @property \app\models\Province $province
 * @property \app\models\Village $village
 * @property \app\models\Studentguardian[] $studentguardians
 */
class Guardian extends \yii\db\ActiveRecord
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
            'commune',
            'district',
            'gender',
            'province',
            'village',
            'studentguardians'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gender_id', 'province_id', 'district_id', 'commune_id', 'village_id', 'forename', 'surname', 'mobile'], 'required'],
            [['gender_id', 'province_id', 'district_id', 'commune_id', 'village_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['forename', 'surname', 'streetAddress', 'mobile', 'position'], 'string', 'max' => 50],
            [['email','workplace'], 'string', 'max' => 100],
            [['code'], 'string', 'max' => 20],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }
    public function getFullname(){
        return $this->forename . ' ' . $this->surname;
}

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'guardian';
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
            'forename' => Yii::t('app', 'Forename'),
            'surname' => Yii::t('app', 'Surname'),
            'gender_id' => Yii::t('app', 'Gender'),
            'streetAddress' => Yii::t('app', 'Street Address'),
            'province_id' => Yii::t('app', 'Province'),
            'district_id' => Yii::t('app', 'District'),
            'commune_id' => Yii::t('app', 'Commune'),
            'village_id' => Yii::t('app', 'Village'),
            'email' => Yii::t('app', 'Email'),
            'mobile' => Yii::t('app', 'Mobile'),
            'workplace' => Yii::t('app', 'Workplace'),
            'position' => Yii::t('app', 'Position'),
            'lock' => Yii::t('app', 'Lock'),
        ];
    }

    public function getCompleteAddress(){
        $address = $this->streetAddress;
        if(!empty($this->province)){
            $address = $address . ' , ' . $this->province->name . ' , ';
        }else{ $address = 'Unidentified' . ' , '; }

        if(!empty($this->district)){
            $address = $address . $this->district->name . ' , ';
        }else{ $address = $address . 'Unidentified' . ' , '; }

        if(!empty($this->commune)){
            $address = $address . $this->commune->name . ' , ';
        }else{ $address = $address . 'Unidentified' . ' , '; }

        if(!empty($this->village)){
            $address = $address . $this->commune->name;
        }else{ $address = $address . 'Unidentified'; }

        return $address;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommune()
    {
        return $this->hasOne(\app\models\Commune::className(), ['id' => 'commune_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(\app\models\District::className(), ['id' => 'district_id']);
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
    public function getProvince()
    {
        return $this->hasOne(\app\models\Province::className(), ['id' => 'province_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVillage()
    {
        return $this->hasOne(\app\models\Village::className(), ['id' => 'village_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentguardians()
    {
        return $this->hasMany(\app\models\Studentguardian::className(), ['guardian_id' => 'id']);
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
     * @return \app\models\GuardianQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\GuardianQuery(get_called_class());
        return $query->where(['guardian.deleted_by' => 0]);
    }
}
