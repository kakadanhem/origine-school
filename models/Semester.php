<?php

namespace app\models;

use Yii;
use \app\models\base\Semester as BaseSemester;

/**
 * This is the model class for table "semester".
 */
class Semester extends BaseSemester
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['academicYear_id','days', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['startDate','endDate','created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['startDate','endDate'], 'required'],
            [['description'], 'string', 'max' => 50],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $start = date_create($this->startDate);
        $end = date_create($this->endDate);

        $this->days = $start->diff($end)->days;

        return true;
    }
	
}
