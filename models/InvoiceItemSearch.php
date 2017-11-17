<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InvoiceItem;

/**
 * app\models\InvoiceItemSearch represents the model behind the search form about `app\models\InvoiceItem`.
 */
 class InvoiceItemSearch extends InvoiceItem
{
    public $invoiceNo;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fee_id', 'is_amount', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['amount', 'discount'], 'number'],
            [['invoiceNo','created_at', 'updated_at', 'deleted_at'], 'safe'],
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
        $query = InvoiceItem::find();
        $query->joinWith('invoice');
        $query->leftJoin('enrollment','invoice.enrollment_id = enrollment.id');
        $query->leftJoin('student','enrollment.student_id = student.id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['invoiceNo'] = [
            'asc' => ['invoice.invoiceNo' => SORT_ASC],
            'desc' => ['invoice.invoiceNo' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'fee_id' => $this->fee_id,
            'amount' => $this->amount,
            'discount' => $this->discount,
            'is_amount' => $this->is_amount,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
            'lock' => $this->lock,
        ]);

        $query->andFilterWhere(['or',
            ['like', 'invoice.invoiceNo'  ,$this->invoiceNo],
            ['like', 'student.forenameEn' , $this->invoiceNo],
            ['like', 'student.surnameEn'  , $this->invoiceNo]
        ]);

        return $dataProvider;
    }
}
