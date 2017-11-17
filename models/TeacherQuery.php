<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Teacher]].
 *
 * @see Teacher
 */
class TeacherQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Teacher[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Teacher|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
