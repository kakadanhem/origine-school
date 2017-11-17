<?php

namespace app\models;

use Yii;
use \app\models\base\FeeGroup as BaseFeeGroup;

/**
 * This is the model class for table "feegroup".
 */
class FeeGroup extends BaseFeeGroup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['code'], 'string', 'max' => 50],
			[['description'], 'string', 'max' => 200],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
