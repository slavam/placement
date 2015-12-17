<?php

namespace app\models\queries;

/**
 * This is the ActiveQuery class for [[\app\models\Doc]].
 *
 * @see \app\models\Doc
 */
class DocQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[rec_status_id]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return \app\models\Doc[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Doc|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}