<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DiscountGroup;

/**
 * app\models\DiscountGroupSearch represents the model behind the search form about `app\models\DiscountGroup`.
 */
 class DiscountGroupSearch extends DiscountGroup
{
    /**
     * @inheritdoc
     */
    public $enrollment_id;


    public function rules()
    {
        return [
            [['id', 'discountGroupType_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at','enrollment_id'], 'safe'],
        ];
    }

     /**
      * @inheritdoc
      */
     public function attributeLabels()
     {
         return [
             'enrollment_id' => Yii::t('app', 'Enrollment'),
         ];
     }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = DiscountGroup::find();
        $query->joinWith('discountgroupdetails');
        $query->rightJoin('enrollment', 'discountgroupdetail.enrollment_id = enrollment.id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'discountgroup.id' => $this->id,
            'discountgroup.discountGroupType_id' => $this->discountGroupType_id,
            'discountgroup.created_at' => $this->created_at,
            'discountgroup.created_by' => $this->created_by,
            'discountgroup.updated_at' => $this->updated_at,
            'discountgroup.updated_by' => $this->updated_by,
            'discountgroup.deleted_at' => $this->deleted_at,
            'discountgroup.deleted_by' => $this->deleted_by,
            'discountgroup.lock' => $this->lock,
        ]);

        $query->andFilterWhere(['enrollment.id' => $this->enrollment_id]);

        return $dataProvider;
    }
}
