<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[DiscountGroupTypeDetail]].
 *
 * @see DiscountGroupTypeDetail
 */
class DiscountGroupTypeDetailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return DiscountGroupTypeDetail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return DiscountGroupTypeDetail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
