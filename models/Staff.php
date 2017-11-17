<?php

namespace app\models;

use Yii;
use \app\models\base\Staff as BaseStaff;

/**
 * This is the model class for table "staff".
 */
class Staff extends BaseStaff
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['gender_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['birthdate', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['birthplace', 'address'], 'string'],
            [['forename', 'surname', 'nationality', 'religion', 'email', 'mobile'], 'string', 'max' => 50],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
