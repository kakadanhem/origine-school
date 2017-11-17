<?php

namespace app\models;

use Yii;
use \app\models\base\Address as BaseAddress;

/**
 * This is the model class for table "address".
 */
class Address extends BaseAddress
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['village_id', 'commune_id', 'district_id', 'province_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['streetAddress'], 'string', 'max' => 50],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
