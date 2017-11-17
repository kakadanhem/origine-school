<?php

namespace app\models;

use Yii;
use \app\models\base\GroupGrade as BaseGroupGrade;

/**
 * This is the model class for table "groupGrade".
 */
class GroupGrade extends BaseGroupGrade
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['grade_id', 'group_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
