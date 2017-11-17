<?php
namespace app\components;

use Yii;
use app\models\Invoice;
use machour\yii2\notifications\models\Notification as BaseNotification;

class Notification extends BaseNotification
{

    /**
     * A due invoice notification
     */
    const KEY_INVOICE_NEARLY_DUE_MESSAGE = 'nearly_due_invoice';

    /**
     * @var array Holds all usable notifications
     */
    public static $keys = [
        self::KEY_INVOICE_NEARLY_DUE_MESSAGE,
    ];

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        switch ($this->key) {
            case self::KEY_INVOICE_NEARLY_DUE_MESSAGE:
                $invoice = Invoice::findOne($this->key_id);
                return Yii::t('app', 'Invoice {invoice} Nearly Due', [
                    'invoice' => $invoice->invoiceNo,
                ]);
        }
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        switch ($this->key) {

            case self::KEY_INVOICE_NEARLY_DUE_MESSAGE:
                $invoice = Invoice::findOne($this->key_id);
                return Yii::t('app', 'The {invoice} invoice is due at {date}', [
                    'invoice' => $invoice->invoiceNo,
                    'date' => $invoice->dueDate,
                ]);
        }
    }

    /**
     * @inheritdoc
     */
    public function getRoute()
    {
        switch ($this->key) {
            case self::KEY_INVOICE_NEARLY_DUE_MESSAGE:
                return ['/finance/invoice/view', 'id' => $this->key_id];
        };
    }

}