<?php

namespace app\models;

use Yii;
use \app\models\base\InvoiceItem as BaseInvoiceItem;

/**
 * This is the model class for table "invoiceitem".
 */
class InvoiceItem extends BaseInvoiceItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['invoice_id', 'fee_id', 'is_amount', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['amount','fin_amount', 'discount'], 'number'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
