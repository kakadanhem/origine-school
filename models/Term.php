<?php

namespace app\models;

use Yii;
use \app\models\base\Term as BaseTerm;

/**
 * This is the model class for table "term".
 */
class Term extends BaseTerm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['startDate', 'endDate', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['semester_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
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

    public function calculateMonthDays(){
        $ts1 = strtotime($this->startDate);
        $ts2 = strtotime($this->endDate);
        $baseDate = strtotime($this->startDate);

        $yearStart = date('Y', $ts1);
        $yearEnd = date('Y', $ts2);

        $startMonth = date('m', $ts1);
        $endMonth = date('m', $ts2);

        $number1 = cal_days_in_month(CAL_GREGORIAN, $startMonth, $yearStart) - date('d', $ts1);
        $number2 = date('d', $ts2); ;

        $diff = (($yearEnd - $yearStart) * 12) + ($endMonth - $startMonth);

        $date[$yearStart][(int)$startMonth] = (int)$number1;
        for($i = 1; $i < $diff; $i++){
            $baseDate = strtotime(date("Y-m-d", strtotime("+1 month", $baseDate)));
            $currentMonth = date('m', $baseDate);
            $currentYear = date('y', $baseDate);
            $date[date('Y', $baseDate)][(int)$currentMonth] = cal_days_in_month(CAL_GREGORIAN, $currentMonth , $currentYear);
        }
        $date[$yearEnd][(int)$endMonth] = (int)$number2;

        return $date;
    }

    public function getMonths(){
        $ts1 = strtotime($this->startDate);
        $ts2 = strtotime($this->endDate);

        $yearStart = date('Y', $ts1);
        $yearEnd = date('Y', $ts2);

        $startMonth = date('m', $ts1);
        $endMonth = date('m', $ts2);

        return $endMonth - $startMonth + (($yearEnd - $yearStart) * 12) + 1;
        // 09-2017 - 08-2017 is only 1 month but it actually 2 months
    }
	
}
