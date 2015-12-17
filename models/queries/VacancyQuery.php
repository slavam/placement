<?php

namespace app\models\queries;

/**
 * This is the ActiveQuery class for [[\app\models\Vacancy]].
 *
 * @see \app\models\Vacancy
 */
class VacancyQuery extends \yii\db\ActiveQuery
{
    public function init()
    {

        $workplace_id = null;
        if (\Yii::$app->user->can('FilterByWorkplace'))
            $workplace_id = \Yii::$app->user->identity->workplace_id ? \Yii::$app->user->identity->workplace_id : 0;

        $user_id = null;
        if (\Yii::$app->user->can('FilterByUser'))
            $user_id = \Yii::$app->user->id ? \Yii::$app->user->id : 0;

        $this->andFilterWhere(['or',
            ['=', 'vacancy.user_id', $user_id],
            ['=', 'vacancy.workplace_id', $workplace_id],
        ]);

        parent::init();
    }

    public function active()
    {
        $this->andWhere('[[rec_status_id]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return \app\models\Vacancy[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Vacancy|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}