<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Appendix]].
 *
 * @see Appendix
 */
class AppendixQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Appendix[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Appendix|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
