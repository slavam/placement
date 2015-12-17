<?php

namespace app\models\queries;

/**
 * This is the ActiveQuery class for [[\app\models\File]].
 *
 * @see \app\models\File
 */
class FileQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[rec_status_id]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return \app\models\File[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\File|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}