<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Session]].
 *
 * @see Session
 */
class SessionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Session[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Session|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
