<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[GroupCourseDetail]].
 *
 * @see GroupCourseDetail
 */
class GroupCourseDetailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return GroupCourseDetail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return GroupCourseDetail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
