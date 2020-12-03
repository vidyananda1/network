<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Counter;

/**
 * CounterSearch represents the model behind the search form of `app\models\Counter`.
 */
class CounterSearch extends Counter
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'member_code', 'created_by', 'updated_by'], 'integer'],
            [['investor_name', 'date_of_payment', 'invested_amount', 'status', 'created_date', 'updated_date', 'record_status','no_of_downmember'], 'safe'],
            [['rate_of_interest', 'paid_amount'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Counter::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'member_code' => $this->member_code,
            'date_of_payment' => $this->date_of_payment,
            'rate_of_interest' => $this->rate_of_interest,
            'paid_amount' => $this->paid_amount,
            'created_by' => $this->created_by,
            'created_date' => $this->created_date,
            'updated_by' => $this->updated_by,
            'updated_date' => $this->updated_date,
            'no_of_downmember' => $this->no_of_downmember,
        ]);

        $query->andFilterWhere(['like', 'investor_name', $this->investor_name])
            ->andFilterWhere(['like', 'invested_amount', $this->invested_amount])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'record_status', $this->record_status]);

        return $dataProvider;
    }
}
