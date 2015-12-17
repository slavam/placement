<?php

namespace app\models\queries;

/**
 * This is the ActiveQuery class for [[\app\models\DocPatent]].
 *
 * @see \app\models\DocPatent
 */
class DocPatentQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[rec_status_id]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return \app\models\DocPatent[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\DocPatent|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}