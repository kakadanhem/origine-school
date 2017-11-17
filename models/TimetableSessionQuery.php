<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[TimetableSession]].
 *
 * @see TimetableSession
 */
class TimetableSessionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return TimetableSession[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TimetableSession|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
