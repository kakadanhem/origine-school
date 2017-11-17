<?php

namespace app\modules\academic\EnrollmentTool\models;

use app\models\Enrollment;
use app\modules\academic\EnrollmentTool\EnrollmentTool;

/**
 * This is the model class for table "enrollmentfee".
 */
class EnrollmentFee extends \app\models\base\Enrollment
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => EnrollmentTool::t('Enrollment','ID'),
            'enrollment_id' => EnrollmentTool::t('Enrollment','Enrollment'),
            'fee_id' => EnrollmentTool::t('Enrollment','Fee'),
            'amount' => EnrollmentTool::t('Enrollment','Amount'),
            'discount' => EnrollmentTool::t('Enrollment','Discount'),
            'is_amount' => EnrollmentTool::t('Enrollment','Amount'),
            'lock' => EnrollmentTool::t('Enrollment','Lock'),
        ];
    }
	
}
