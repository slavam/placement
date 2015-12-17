<?php

namespace app\models\queries;

/**
 * This is the ActiveQuery class for [[\app\models\Workplace]].
 *
 * @see \app\models\Workplace
 */
class WorkplaceQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[rec_status_id]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return \app\models\Workplace[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Workplace|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}