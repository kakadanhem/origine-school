<?php

namespace app\models;

use kartik\daterange\DateRangeBehavior;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Invoice;

/**
 * app\models\InvoiceSearch represents the model behind the search form about `app\models\Invoice`.
 */
 class InvoiceSearch extends Invoice
{
     public $dueDateRange;
     public $dueDateStart;
     public $dueDateEnd;

     public $student_id;
     public $grade_id;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'enrollment_id','student_id','grade_id', 'is_amount', 'status_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['invoiceNo', 'dueDate', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['dueDateStart'], 'default','value' => date('Y-m-d', strtotime('-6 months'))],
            [['dueDateEnd'], 'default','value' => date('Y-m-d', strtotime('+6 months'))],
            [['dueDateRange'], 'match', 'pattern' => '/^.+\s\-\s.+$/'],
            [['discount'], 'number'],
        ];
    }


     public function behaviors()
     {
         return [
             [
                 'class' => DateRangeBehavior::className(),
                 'attribute' => 'dueDateRange',
                 'dateStartAttribute' => 'dueDateStart',
                 'dateEndAttribute' => 'dueDateEnd',
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
        $query = Invoice::find();
        $query->joinWith(['enrollment']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['student_id'] = [
            'asc' => ['enrollment.student.forenameEn' => SORT_ASC],
            'desc' => ['enrollment.student.forenameEn' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['grade_id'] = [
            'asc' => ['enrollment.grade_id' => SORT_ASC],
            'desc' => ['enrollment.grade_id' => SORT_DESC],
        ];


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'enrollment_id' => $this->enrollment_id,
            'discount' => $this->discount,
            'is_amount' => $this->is_amount,
            'status_id' => $this->status_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
            'lock' => $this->lock,
            'enrollment.student_id' => $this->student_id,
        ]);

        $query->andFilterWhere(['like', 'invoiceNo', $this->invoiceNo]);

        $query->andWhere(['>=', 'dueDate', $this->dueDateStart]);
        $query->andWhere(['<=', 'dueDate', $this->dueDateEnd]);

        return $dataProvider;
    }
}
