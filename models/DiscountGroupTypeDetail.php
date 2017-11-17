<?php

namespace app\models;

use Yii;
use \app\models\base\DiscountGroupTypeDetail as BaseDiscountGroupTypeDetail;

/**
 * This is the model class for table "discountgrouptypedetail".
 */
class DiscountGroupTypeDetail extends BaseDiscountGroupTypeDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['type_id', 'number_least', 'number_most', 'isamount', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['discount'], 'number'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
