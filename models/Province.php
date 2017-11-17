<?php

namespace app\models;

use Yii;
use \app\models\base\Province as BaseProvince;

/**
 * This is the model class for table "province".
 */
class Province extends BaseProvince
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['id'], 'required'],
            [['id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['name'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
