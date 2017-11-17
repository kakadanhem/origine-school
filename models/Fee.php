<?php

namespace app\models;

use Yii;
use \app\models\base\Fee as BaseFee;

/**
 * This is the model class for table "fee".
 */
class Fee extends BaseFee
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['amount'], 'number'],
            [['program_id','grade_id','feeCategory_id','feeType_id','scheduleType_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['description'], 'string', 'max' => 50],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
