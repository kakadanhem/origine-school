<?php

namespace app\models;

use Yii;
use \app\models\base\Branch as BaseBranch;

/**
 * This is the model class for table "branch".
 */
class Branch extends BaseBranch
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['streetAddress_id', 'school_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name', 'telephone', 'email', 'website'], 'string', 'max' => 50],
            [['shortName', 'code',], 'string', 'max' => 10],
            [['image_src', 'image_web'], 'string', 'max' => 255],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
