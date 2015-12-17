<?php

namespace app\models\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Experience;

/**
 * ExperienceSearch represents the model behind the search form about `app\models\Experience`.
 */
class ExperienceSearch extends Experience
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'person_id', 'education_type_id', 'profession_id', 'city_id', 'duration', 'rec_status_id', 'user_id'], 'integer'],
            [['firm', 'date_start', 'date_end', 'note', 'dc'], 'safe'],
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
        $query = Experience::find();

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
            'type_id' => $this->type_id,
            'person_id' => $this->person_id,
            'education_type_id' => $this->education_type_id,
            'profession_id' => $this->profession_id,
            'city_id' => $this->city_id,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'duration' => $this->duration,
            'rec_status_id' => $this->rec_status_id,
            'user_id' => $this->user_id,
            'dc' => $this->dc,
        ]);

        $query->andFilterWhere(['like', 'firm', $this->firm])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
