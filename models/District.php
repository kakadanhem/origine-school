<?php

namespace app\models;

use Yii;
use \app\models\base\District as BaseDistrict;

/**
 * This is the model class for table "district".
 */
class District extends BaseDistrict
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['id', 'name', 'provinces_id'], 'required'],
            [['id', 'provinces_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['name'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
