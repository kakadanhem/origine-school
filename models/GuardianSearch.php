<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Guardian;

/**
 * app\models\GuardianSearch represents the model behind the search form about `app\models\Guardian`.
 */
 class GuardianSearch extends Guardian
{
    /**
     * @inheritdoc
     */
    public $address;

    public function rules()
    {
        return [
            [['id', 'gender_id', 'province_id', 'district_id', 'commune_id', 'village_id', 'workplace', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['forename', 'surname', 'streetAddress', 'email', 'mobile', 'position', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['address'], 'string'],
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
        $query = Guardian::find();
        $query->joinWith('province');
        $query->joinWith('district');
        $query->joinWith('commune');
        $query->joinWith('village');

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
            'id' => $this->id,
            'gender_id' => $this->gender_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'commune_id' => $this->commune_id,
            'village_id' => $this->village_id,
            'workplace' => $this->workplace,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
            'lock' => $this->lock,
        ]);

        $query->andFilterWhere(['like', 'forename', $this->forename])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'streetAddress', $this->streetAddress])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'province.name', $this->address]);

        $query->andFilterWhere(['or',
            ['like', 'streetAddress', $this->address],
            ['like', 'province.name', $this->address],
            ['like', 'district.name', $this->address],
            ['like', 'commune.name', $this->address],
            ['like', 'village.name', $this->address]
        ]);

        return $dataProvider;
    }
}
