<?php

namespace app\models;

use Yii;
use \app\models\base\Session as BaseSession;

/**
 * This is the model class for table "session".
 */
class Session extends BaseSession
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['startTime', 'endTime', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['description'], 'string', 'max' => 50],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
