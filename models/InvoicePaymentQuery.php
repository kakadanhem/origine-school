<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[InvoicePayment]].
 *
 * @see InvoicePayment
 */
class InvoicePaymentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return InvoicePayment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return InvoicePayment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
