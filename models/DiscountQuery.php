<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Discount]].
 *
 * @see Discount
 */
class DiscountQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Discount[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Discount|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
