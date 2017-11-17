<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Fee]].
 *
 * @see Fee
 */
class FeeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Fee[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Fee|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
