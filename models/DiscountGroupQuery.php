<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[DiscountGroup]].
 *
 * @see DiscountGroup
 */
class DiscountGroupQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return DiscountGroup[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return DiscountGroup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
