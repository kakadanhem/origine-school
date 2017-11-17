<?php

namespace app\models;

use Yii;
use \app\models\base\DiscountGroupDetail as BaseDiscountGroupDetail;

/**
 * This is the model class for table "discountgroupdetail".
 */
class DiscountGroupDetail extends BaseDiscountGroupDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['discountGroup_id', 'enrollment_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
