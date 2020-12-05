<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Registration;

/**
 * RegistrationSearch represents the model behind the search form of `app\models\Registration`.
 */
class RegistrationSearch extends Registration
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by'], 'integer'],
            [['investor_name', 'phone', 'address', 'aadhaar', 'date', 'member_code', 'referral_code', 'created_date', 'updated_date', 'referral_status','record_status'], 'safe'],
            [['regis_amount', 'invest_amount', 'total'], 'number'],
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
        $query = Registration::find();

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
            'date' => $this->date,
            'referral_status' => $this->referral_status,
            'regis_amount' => $this->regis_amount,
            'invest_amount' => $this->invest_amount,
            'total' => $this->total,
            'created_by' => $this->created_by,
            'created_date' => $this->created_date,
            'updated_by' => $this->updated_by,
            'updated_date' => $this->updated_date,
        ]);

        $query->andFilterWhere(['like', 'investor_name', $this->investor_name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'aadhaar', $this->aadhaar])
            ->andFilterWhere(['like', 'member_code', $this->member_code])
            ->andFilterWhere(['like', 'referral_code', $this->referral_code])
            ->andFilterWhere(['like', 'record_status', $this->record_status]);

        return $dataProvider;
    }
}
