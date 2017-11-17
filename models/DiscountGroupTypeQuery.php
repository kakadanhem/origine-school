<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[DiscountGroupType]].
 *
 * @see DiscountGroupType
 */
class DiscountGroupTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return DiscountGroupType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return DiscountGroupType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
