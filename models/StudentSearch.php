<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Student;

/**
 * app\models\StudentSearch represents the model behind the search form about `app\models\Student`.
 */
 class StudentSearch extends Student
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'gender_id', 'nationality_id', 'religion_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['code','fullname','allFullname','forenameEn', 'surnameEn', 'forenameKh', 'surnameKh', 'nickname', 'birthdate', 'passportNo', 'passportExpire', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
     public function getAllFullname()
     {
         return $this->forenameEn . ' ' . $this->surnameEn . ' ( ' . $this->surnameKh . ' ' . $this->forenameKh . ' ) ';
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
        $query = Student::find();

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
            'student.id' => $this->id,
            'gender_id' => $this->gender_id,
            'birthdate' => $this->birthdate,
            'nationality_id' => $this->nationality_id,
            'religion_id' => $this->religion_id,
            'passportExpire' => $this->passportExpire,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
            'lock' => $this->lock,
        ]);

        $query->andFilterWhere(['like', 'forenameEn', $this->forenameEn])
            ->andFilterWhere(['like', 'surnameEn', $this->surnameEn])
            ->andFilterWhere(['like', 'forenameKh', $this->forenameKh])
            ->andFilterWhere(['like', 'surnameKh', $this->surnameKh])
            ->andFilterWhere(['like', 'nickname', $this->nickname])
            ->andFilterWhere(['like', 'passportNo', $this->passportNo]);

        $query->joinWith(array('gender'));
        $query->andFilterWhere(['appendix.id' => $this->gender_id,])
            ->andFilterWhere(['like', 'gender.description', $this->getAttribute('gender.description')])
            ->andFilterWhere(['like', 'religion.description', $this->getAttribute('religion.description')]);

        $query->joinWith(array('nationality'));
        $query->andFilterWhere(['nationality.id' => $this->nationality,])
            ->andFilterWhere(['like', 'nationality.nationality', $this->getAttribute('nationality.nationality')]);


        return $dataProvider;
    }
}
