<?php

namespace app\models;

use Yii;
use \app\models\base\StudentGuardian as BaseStudentGuardian;

/**
 * This is the model class for table "studentguardian".
 */
class StudentGuardian extends BaseStudentGuardian
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['student_id', 'guardian_id', 'relationship_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator'],
            [['student_id', 'guardian_id'], 'unique', 'targetAttribute' => ['student_id', 'guardian_id'], 'message' => 'Relationship betweent them is already existed'],
        ]);
    }
	
}
