<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Commune]].
 *
 * @see Commune
 */
class CommuneQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Commune[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Commune|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
