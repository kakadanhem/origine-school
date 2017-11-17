<?php

namespace app\models;

use Yii;
use \app\models\base\TimetableSession as BaseTimetableSession;

/**
 * This is the model class for table "timetableSession".
 */
class TimetableSession extends BaseTimetableSession
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['session_id', 'timetable_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
