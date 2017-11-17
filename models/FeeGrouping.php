<?php

namespace app\models;

use Yii;
use \app\models\base\FeeGrouping as BaseFeeGrouping;

/**
 * This is the model class for table "feegrouping".
 */
class FeeGrouping extends BaseFeeGrouping
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['fee_id', 'feeGroup_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
