<?php

namespace app\models;

use Yii;
use \app\models\base\Group as BaseGroup;

/**
 * This is the model class for table "group".
 */
class Group extends BaseGroup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['maxEnrollment', 'term_id', 'timetable_id', 'grade_id', 'branch_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['code'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 200],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
