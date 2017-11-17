<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "branch".
 *
 * @property integer $id
 * @property string $name
 * @property string $shortName
 * @property string $code
 * @property integer $streetAddress_id
 * @property string $telephone
 * @property string $email
 * @property string $website
 * @property string $image_src
 * @property string $image_web
 * @property integer $school_id
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $deleted_at
 * @property integer $deleted_by
 * @property integer $lock
 *
 * @property \app\models\School $school
 * @property \app\models\Address $streetAddress
 */
class Branch extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    private $_rt_softdelete;
    private $_rt_softrestore;
    public $image;

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
            'school',
            'streetAddress'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['streetAddress_id', 'school_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['telephone', 'email', 'website'], 'string', 'max' => 50],
            [['shortName', 'code',], 'string', 'max' => 10],
            [['image_src', 'image_web'], 'string', 'max' => 255],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'branch';
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
            'name' => 'Name',
            'shortName' => 'Short Name',
            'code' => 'Code',
            'streetAddress_id' => 'Street Address ID',
            'telephone' => 'Telephone',
            'email' => 'Email',
            'website' => 'Website',
            'image_src' => 'Image Src',
            'image_web' => 'Image Web',
            'school_id' => 'School ID',
            'lock' => 'Lock',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchool()
    {
        return $this->hasOne(\app\models\School::className(), ['id' => 'school_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStreetAddress()
    {
        return $this->hasOne(\app\models\Address::className(), ['id' => 'streetAddress_id']);
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
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(\app\models\Group::className(), ['branch_id' => 'id']);
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
     * @return \app\models\BranchQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\models\BranchQuery(get_called_class());
        return $query->where(['deleted_by' => 0]);
    }
}
