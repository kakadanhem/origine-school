<?php

namespace app\models;

use Yii;
use \app\models\base\AcademicYear as BaseAcademicYear;

/**
 * This is the model class for table "academicYear".
 */
class AcademicYear extends BaseAcademicYear
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['startDate', 'endDate','created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['description'], 'string', 'max' => 50],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if($this->active == 1){
            $academicYears = AcademicYear::find()->where(['!=','id', $this->id])->all();
            foreach($academicYears as $year){
                $year->active = false;
                $year->save();
            }
        }
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
