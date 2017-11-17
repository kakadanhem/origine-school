<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[FeeGrouping]].
 *
 * @see FeeGrouping
 */
class FeeGroupingQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return FeeGrouping[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return FeeGrouping|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
