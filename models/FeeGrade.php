<?php

namespace app\models;

use Yii;
use \app\models\base\FeeGrade as BaseFeeGrade;

/**
 * This is the model class for table "feegrade".
 */
class FeeGrade extends BaseFeeGrade
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['amount'], 'number'],
            [['grade_id', 'type_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['description'], 'string', 'max' => 50],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
