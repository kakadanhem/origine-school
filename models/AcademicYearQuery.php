<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AcademicYear]].
 *
 * @see AcademicYear
 */
class AcademicYearQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return AcademicYear[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AcademicYear|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
