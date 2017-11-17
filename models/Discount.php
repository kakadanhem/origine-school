<?php

namespace app\models;

use Yii;
use \app\models\base\Discount as BaseDiscount;

/**
 * This is the model class for table "discount".
 */
class Discount extends BaseDiscount
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 200],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
