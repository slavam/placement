<?php

namespace app\models\queries;

/**
 * This is the ActiveQuery class for [[\app\models\Region]].
 *
 * @see \app\models\Region
 */
class RegionQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[rec_status_id]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return \app\models\Region[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Region|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}