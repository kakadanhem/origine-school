<?php

namespace app\models;

use Yii;
use app\models\base\Student as BaseStudent;

/**
 * This is the model class for table "student".
 */
class Student extends BaseStudent
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['forenameEn', 'surnameEn', 'forenameKh', 'surnameKh', 'gender_id', 'birthdate', 'nationality_id'], 'required'],
            [['gender_id', 'nationality_id', 'religion_id', 'created_by','discount_id', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['gender.description','nationality.nationality', 'religion.description','birthdate', 'code', 'passportExpire', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['forenameEn', 'surnameEn', 'forenameKh', 'surnameKh', 'nickname', 'passportNo'], 'string', 'max' => 50],
            [['code'], 'string', 'max' => 20],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if($this->isNewRecord){

            $setting = Setting::findOne(['code' => 'PRE-STU-CODE']);
            $parameter = '';

            if($setting->parameter1 != NULL){
                $parameter = $setting->analyzeParameter($setting->parameter1);
            }
            if($setting->parameter2 != NULL){
                $parameter .= $setting->analyzeParameter($setting->parameter2);
            }
            if($setting->parameter3 != NULL){
                $parameter .= $setting->analyzeParameter($setting->parameter3);
            }

            if($setting->parameter4 != NULL){
            $parameter4 = $setting->analyzeParameter($setting->parameter4);
            }else{
                $parameter4 = 5;
            }

            $year = date('Y');

            if( strpos( $parameter, $year ) == true ) {
                $number = Student::find()->where(['like', 'code', $year])->count() + 1;
            }
            else{
            $number = Student::find()->count() + 1;
            }
            $this->code = $parameter . sprintf('%0' . $parameter4 . 'd',$number);
        }
        else{

        }

        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if($insert){

        }
    }
	
}
