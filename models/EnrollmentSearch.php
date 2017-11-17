<?php

namespace app\models;

use kartik\daterange\DateRangeBehavior;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Enrollment;


/**
 * app\models\EnrollmentSearch represents the model behind the search form about `app\models\Enrollment`.

 */
 class EnrollmentSearch extends Enrollment
{
     public $enrollDateRange;
     public $enrollDateStart;
     public $enrollDateEnd;
     public $gender_id;


    /**
     * @inheritdoc
     */
     public function init()
     {
     }

    public function attributeLabels()
    {
        return [
            'searchprgoram_id' => 'Program',
            'grade_id' => 'Grade',
            'student_id' => 'Student',
            'paymentStatus_id' => 'Payment Status',
            'branch_id' => 'Branch',
        ];
    }

     public function rules()
    {
        return [
            [['gender_id','paymentStatus_id','searchprgoram_id','academicYear_id','id', 'student_id','payTerm_id', 'grade_id', 'branch_id','enrollType_id', 'discount_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['payTerm_id','enrollDate', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['enrollDateStart'], 'default','value' => date('Y-m-d', strtotime('-6 months'))],
            [['enrollDateEnd'], 'default','value' => date('Y-m-d', strtotime('+6 months'))],
            [['enrollDateRange'], 'match', 'pattern' => '/^.+\s\-\s.+$/'],
        ];
    }

     public function behaviors()
     {
         return [
             [
                 'class' => DateRangeBehavior::className(),
                 'attribute' => 'enrollDateRange',
                 'dateStartAttribute' => 'enrollDateStart',
                 'dateEndAttribute' => 'enrollDateEnd',
             ]
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
        $query = Enrollment::find();
        $query->joinWith(['grade']);
        $query->joinWith(['student']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['gender_id'] = [
            'asc' => ['student.gender.description' => SORT_ASC],
            'desc' => ['student.gender.description' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'student_id' => $this->student_id,
            'grade_id' => $this->grade_id,
            'branch_id' => $this->branch_id,
            'payTerm_id' => $this->payTerm_id,
            'enrollType_id' => $this->enrollType_id,
            'discount_id' => $this->discount_id,
            'paymentStatus_id' => $this->paymentStatus_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'deleted_at' => $this->deleted_at,
            'deleted_by1' => $this->deleted_by,
            'lock' => $this->lock,
            'grade.program_id' => $this->searchprogram_id,
            'student.id' => $this->gender_id,
        ]);

        $query->andWhere(['>=', 'enrollDate', $this->enrollDateStart]);
        $query->andWhere(['<=', 'enrollDate', $this->enrollDateEnd]);

        return $dataProvider;
    }
}
