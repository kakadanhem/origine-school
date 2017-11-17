<?php

namespace app\models;

use Yii;
use \app\models\base\DiscountGroup as BaseDiscountGroup;

/**
 * This is the model class for table "discountgroup".
 */
class DiscountGroup extends BaseDiscountGroup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['discountGroupType_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['code'], 'string', 'max' => 20],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
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
            $setting = Setting::findOne(['code' => 'PRE-DISG-CODE']);
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
        $countDiscountGroupItem = DiscountGroupDetail::find()->where(['discountGroup_id' => $this->id])->count();
        $discountGroupItems = $this->discountgroupdetails;
        $discountGroupTypeDetails = $this->discountGroupType->discountgrouptypedetails;
        foreach ($discountGroupTypeDetails as $item){
            if($countDiscountGroupItem >= $item->number_least){
                foreach($discountGroupItems as $dGroupItem){
                    foreach($dGroupItem->enrollment->enrollmentFees as $fee){
                        if($fee->fee->feeCategory->description == 'Tuition'){
                            $fee->discount = $item->discount;
                            $fee->is_amount = $item->isamount;
                            $fee->save();
                        }
                    }
                }
            }
        }
    }
	
}
