<?php

namespace app\models;

use Yii;
use \app\models\base\EnrollmentFee as BaseEnrollmentFee;

/**
 * This is the model class for table "enrollmentfee".
 */
class EnrollmentFee extends BaseEnrollmentFee
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['enrollment_id', 'fee_id', 'is_amount', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['amount', 'discount'], 'number'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['lock','discount'], 'default', 'value' => '0'],
            [['is_amount'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
