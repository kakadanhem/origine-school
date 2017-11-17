<?php

namespace app\models;

use Yii;
use \app\models\base\Receipt as BaseReceipt;

/**
 * This is the model class for table "receipt".
 */
class Receipt extends BaseReceipt
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['invoice_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['code'], 'string', 'max' => 50],
            [['paid_by'], 'string', 'max' => 100],
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

            $setting = Setting::findOne(['code' => 'PRE-REC-CODE']);
            $parameter = '';

            if($setting->parameter1 != NULL){
                $parameter = $setting->analyzeParameter($setting->parameter1, $this->invoice->enrollment->branch);
            }
            if($setting->parameter2 != NULL){
                $parameter .= $setting->analyzeParameter($setting->parameter2,  $this->invoice->enrollment->branch);
            }
            if($setting->parameter3 != NULL){
                $parameter .= $setting->analyzeParameter($setting->parameter3,  $this->invoice->enrollment->branch);
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
