<?php

namespace app\models;

use Yii;
use \app\models\base\EnrollmentCurrentPaymentStatus as BaseEnrollmentCurrentPaymentStatus;

/**
 * This is the model class for table "enrollmentcurrentpaymentstatus".
 */
class EnrollmentCurrentPaymentStatus extends BaseEnrollmentCurrentPaymentStatus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['enrollment_id', 'status_id'], 'required'],
            [['enrollment_id', 'status_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['amount'], 'number'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
