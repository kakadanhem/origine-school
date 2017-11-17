<?php

namespace app\models;

use Yii;
use \app\models\base\Setting as BaseSetting;

/**
 * This is the model class for table "setting".
 */
class Setting extends BaseSetting
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['code', 'category'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 100],
            [['parameter1', 'parameter2', 'parameter3', 'parameter4'], 'string', 'max' => 10],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }


    public function analyzeParameter($parameter, Branch $branch = null)
    {
        if ($parameter == '{year}') {
            return date("Y");
        }
        elseif ($parameter == '{branch.code}'){
            return $branch->code;
        }
        elseif ($parameter == '{branch.name}'){
            return $branch->shortName;
        }
        else{
            return $parameter;
        }
    }
	
}
