<?php

namespace app\models;

use Yii;
use \app\models\base\Course as BaseCourse;

/**
 * This is the model class for table "course".
 */
class Course extends BaseCourse
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
            [['description'], 'string', 'max' => 50],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
