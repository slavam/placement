<?php

namespace app\models\queries;

/**
 * This is the ActiveQuery class for [[\app\models\Experience]].
 *
 * @see \app\models\Experience
 */
class ExperienceQuery extends \yii\db\ActiveQuery
{
    /**
     * Фильтр записей с типом опыта = "Работа"
     * DefaultScope
     */
    public function init()
    {
        parent::init();
        $this->andWhere(['type_id' => 2]);
    }

    public function active()
    {
        $this->andWhere('[[rec_status_id]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return \app\models\Experience[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Experience|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}