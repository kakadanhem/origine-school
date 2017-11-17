<?php

namespace app\models;

use Yii;
use \app\models\base\DiscountDetail as BaseDiscountDetail;

/**
 * This is the model class for table "discountdetail".
 */
class DiscountDetail extends BaseDiscountDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['discount_id', 'feeCategory_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['value'], 'number'],
            [['isamount'], 'boolean'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
