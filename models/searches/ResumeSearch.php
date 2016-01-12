<?php

namespace app\models\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Resume;

/**
 * ResumeSearch represents the model behind the search form about `app\models\Resume`.
 */
class ResumeSearch extends Resume
{
    // public $professions;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'person_id', 'vacancy_id', 'resume_status_id', 'workplace_id', 'rec_status_id', 'user_id'], 'integer'],
            [['salary'], 'number'],
            [['resumeProfessions', 'date_start', 'date_end', 'note', 'dc'], 'safe'],
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
        $query = Resume::find();
        $query->joinWith(['resumeProfessions']);
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
            'salary' => $this->salary,
            'vacancy_id' => $this->vacancy_id,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'resume_status_id' => $this->resume_status_id,
            'workplace_id' => $this->workplace_id,
            'rec_status_id' => $this->rec_status_id,
            'user_id' => $this->user_id,
            'dc' => $this->dc,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note]);

        if(isset($this->resumeProfessions) and ($this->resumeProfessions>'')){
            $query->andWhere(['resume_profession.profession_id' => $this->resumeProfessions]);
        }

// var_dump($query->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql);        
        return $dataProvider;
    }
}
