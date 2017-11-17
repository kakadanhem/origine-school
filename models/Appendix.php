<?php

namespace app\models;

use Yii;
use \app\models\base\Appendix as BaseAppendix;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "appendix".
 */
class Appendix extends BaseAppendix
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['description'], 'string'],
            [['appendixCategory_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['title'], 'string', 'max' => 50],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }

    public function  getAllBranches(){
        return \yii\helpers\ArrayHelper::map(\app\models\Branch::find()->select(['id', 'CONCAT(shortName, " - ", code) as data']) ->orderBy('data')->asArray()->all(), 'id', 'data');

    }

    public function  getAllPaymentMethod(){
        return \yii\helpers\ArrayHelper::map(\app\models\Appendix::find()
            ->orderBy('title')
            ->where(['appendixCategory_id' => '11'])
            ->asArray()->all(), 'id', 'title');
    }

    public function getAllInvoice(){
    $query = Invoice::find()->select(['invoice.id as id', 'CONCAT(invoice.invoiceNo, " - " ,
             CONCAT(student.forenameEn, " ", student.surnameEn)) as description'])
    ->leftJoin('enrollment', 'invoice.enrollment_id = enrollment.id')
    ->leftJoin('student', 'enrollment.student_id = student.id')
    ->asArray()
    ->all();
    return ArrayHelper::map($query, 'id', 'description');
    }
	
}
