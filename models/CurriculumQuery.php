<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Curriculum]].
 *
 * @see Curriculum
 */
class CurriculumQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Curriculum[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Curriculum|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
