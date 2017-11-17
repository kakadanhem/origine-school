<?php

namespace app\models;

use Yii;
use \app\models\base\Commune as BaseCommune;

/**
 * This is the model class for table "commune".
 */
class Commune extends BaseCommune
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['id', 'name', 'district_id'], 'required'],
            [['id', 'district_id'], 'integer'],
            [['name'], 'string'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
