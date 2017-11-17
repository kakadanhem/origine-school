<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[GroupGrade]].
 *
 * @see GroupGrade
 */
class GroupGradeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return GroupGrade[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return GroupGrade|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
