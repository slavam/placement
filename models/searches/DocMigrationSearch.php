<?php

namespace app\models\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DocMigration;

/**
 * DocMigrationSearch represents the model behind the search form about `app\models\DocMigration`.
 */
class DocMigrationSearch extends DocMigration
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'person_id', 'duration_months', 'duration_days', 'rec_status_id', 'user_id'], 'integer'],
            [['series', 'num', 'date', 'who_give', 'note', 'dc'], 'safe'],
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
        $query = DocMigration::find();

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
            'person_id' => $this->person_id,
            'date' => $this->date,
            'duration_months' => $this->duration_months,
            'duration_days' => $this->duration_days,
            'rec_status_id' => $this->rec_status_id,
            'user_id' => $this->user_id,
            'dc' => $this->dc,
        ]);

        $query->andFilterWhere(['like', 'series', $this->series])
            ->andFilterWhere(['like', 'num', $this->num])
            ->andFilterWhere(['like', 'who_give', $this->who_give])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
