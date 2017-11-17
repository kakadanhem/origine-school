<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[DiscountGroupDetail]].
 *
 * @see DiscountGroupDetail
 */
class DiscountGroupDetailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return DiscountGroupDetail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return DiscountGroupDetail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
