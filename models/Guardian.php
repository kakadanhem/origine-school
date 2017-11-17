<?php

namespace app\models;

use Yii;
use \app\models\base\Guardian as BaseGuardian;

/**
 * This is the model class for table "guardian".
 */
class Guardian extends BaseGuardian
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['gender_id', 'province_id', 'district_id', 'commune_id', 'village_id', 'forename', 'surname', 'mobile'], 'required'],
            [['gender_id', 'province_id', 'district_id', 'commune_id', 'village_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['forename', 'surname', 'streetAddress', 'mobile', 'position'], 'string', 'max' => 50],
            [['email','workplace'], 'string', 'max' => 100],
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

            $setting = Setting::findOne(['code' => 'PRE-GUA-CODE']);
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
	
}
