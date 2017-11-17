<?php

namespace app\models;

use Yii;
use \app\models\base\Village as BaseVillage;

/**
 * This is the model class for table "village".
 */
class Village extends BaseVillage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['id', 'name', 'commune_id'], 'required'],
            [['id', 'commune_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['name'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }


    public function getCompleteAddress(){
        return  empty($this->commune->district->provinces->name)? 'No Province' : $this->commune->district->provinces->name . ', ' .
                empty($this->commune->district->provinces->name)? 'No Province' : $this->commune->district->name . ', ' .
                empty($this->commune->district->provinces->name)? 'No Province' : $this->commune->name . ', ' .
                empty($this->commune->district->provinces->name)? 'No Province' : $this->name . ', ';
    }
	
}
