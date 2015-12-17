<?php

namespace app\models\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Workplace;

/**
 * WorkplaceSearch represents the model behind the search form about `app\models\Workplace`.
 */
class WorkplaceSearch extends Workplace
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'address_id', 'rec_status_id', 'user_id'], 'integer'],
            [['name', 'email', 'phone', 'note', 'dc'], 'safe'],
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
        $query = Workplace::find();

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
            'rec_status_id' => $this->rec_status_id,
            'user_id' => $this->user_id,
            'dc' => $this->dc,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
