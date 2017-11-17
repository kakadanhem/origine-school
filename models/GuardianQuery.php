<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Guardian]].
 *
 * @see Guardian
 */
class GuardianQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Guardian[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Guardian|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
