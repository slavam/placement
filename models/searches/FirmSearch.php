<?php

namespace app\models\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Firm;

/**
 * FirmSearch represents the model behind the search form about `app\models\Firm`.
 */
class FirmSearch extends Firm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'address_id', 'rec_status_id', 'user_id'], 'integer'],
            [['name', 'full_name', 'okpo', 'director', 'email', 'phone', 'bank_name', 'bank_mfo', 'bank_rs', 'svid_num', 'svid_date', 'svid_who_give', 'note', 'dc'], 'safe'],
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
        $query = Firm::find();

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
            'address_id' => $this->address_id,
            'svid_date' => $this->svid_date,
            'rec_status_id' => $this->rec_status_id,
            'user_id' => $this->user_id,
            'dc' => $this->dc,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'okpo', $this->okpo])
            ->andFilterWhere(['like', 'director', $this->director])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'bank_name', $this->bank_name])
            ->andFilterWhere(['like', 'bank_mfo', $this->bank_mfo])
            ->andFilterWhere(['like', 'bank_rs', $this->bank_rs])
            ->andFilterWhere(['like', 'svid_num', $this->svid_num])
            ->andFilterWhere(['like', 'svid_who_give', $this->svid_who_give])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
