<?php

namespace app\models\queries;

/**
 * This is the ActiveQuery class for [[\app\models\Education]].
 *
 * @see \app\models\Education
 */
class EducationQuery extends  \yii\db\ActiveQuery
{
    /**
     * Фильтр записей с типом опыта = "Образование"
     * DefaultScope
     */
    public function init()
    {
        parent::init();
        $this->andWhere(['type_id' => 1]);
    }

    public function active()
    {
        $this->andWhere('[[rec_status_id]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return \app\models\Education[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Education|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}