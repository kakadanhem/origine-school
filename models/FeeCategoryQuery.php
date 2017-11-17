<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[FeeCategory]].
 *
 * @see FeeCategory
 */
class FeeCategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return FeeCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return FeeCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
