<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[FeeGrade]].
 *
 * @see FeeGrade
 */
class FeeGradeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return FeeGrade[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return FeeGrade|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
