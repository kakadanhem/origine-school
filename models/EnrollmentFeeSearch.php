<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EnrollmentFee;

/**
 * app\models\EnrollmentFeeSearch represents the model behind the search form about `app\models\EnrollmentFee`.
 */
 class EnrollmentFeeSearch extends EnrollmentFee
{
    public $student_name;
    public $grade_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'enrollment_id', 'fee_id', 'is_amount', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['amount', 'discount'], 'number'],
            [['student_name','grade_name','created_at', 'updated_at', 'deleted_at'], 'safe'],
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
        $query = EnrollmentFee::find();
        $query->joinWith('enrollment');
        $query->leftJoin('student','enrollment.student_id = student.id');
        $query->leftJoin('grade','enrollment.grade_id = grade.id');

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
            'enrollmentfee.id' => $this->id,
            'enrollmentfee.enrollment_id' => $this->enrollment_id,
            'enrollmentfee.fee_id' => $this->fee_id,
            'enrollmentfee.amount' => $this->amount,
            'enrollmentfee.discount' => $this->discount,
            'enrollmentfee.is_amount' => $this->is_amount,
            'enrollmentfee.created_at' => $this->created_at,
            'enrollmentfee.created_by' => $this->created_by,
            'enrollmentfee.updated_at' => $this->updated_at,
            'enrollmentfee.updated_by' => $this->updated_by,
            'enrollmentfee.deleted_at' => $this->deleted_at,
            'enrollmentfee.deleted_by' => $this->deleted_by,
            'enrollmentfee.lock' => $this->lock,
                    ]);

        $query->andFilterWhere(['like','grade.description', $this->grade_name]);
        $query->andFilterWhere( [ 'OR',
            ['like','student.forenameEn', $this->student_name],
            ['like','student.surnameEn', $this->student_name],
            ['like','student.forenameKh', $this->student_name],
            ['like','student.surnameKh', $this->student_name],
        ]);

        return $dataProvider;
    }
}
