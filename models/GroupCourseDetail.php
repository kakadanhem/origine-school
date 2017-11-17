<?php

namespace app\models;

use Yii;
use \app\models\base\GroupCourseDetail as BaseGroupCourseDetail;

/**
 * This is the model class for table "groupCourseDetail".
 */
class GroupCourseDetail extends BaseGroupCourseDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['group_id', 'course_id', 'teacher_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
