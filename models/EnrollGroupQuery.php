<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[EnrollGroup]].
 *
 * @see EnrollGroup
 */
class EnrollGroupQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return EnrollGroup[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return EnrollGroup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
