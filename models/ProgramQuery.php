<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Program]].
 *
 * @see Program
 */
class ProgramQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Program[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Program|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
