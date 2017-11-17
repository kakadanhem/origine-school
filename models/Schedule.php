<?php

namespace app\models;

use Yii;
use \app\models\base\Schedule as BaseSchedule;

/**
 * This is the model class for table "schedule".
 */
class Schedule extends BaseSchedule
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['groupCourseDetail_id', 'session_id', 'day_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
