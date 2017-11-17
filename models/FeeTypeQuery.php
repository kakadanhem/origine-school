<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[FeeType]].
 *
 * @see FeeType
 */
class FeeTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return FeeType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return FeeType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
