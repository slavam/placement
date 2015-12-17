<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%resume_profession}}".
 *
 * @property integer $id
 * @property integer $resume_id
 * @property integer $profession_id
 * @property string $note
 * @property integer $rec_status_id
 * @property integer $user_id
 * @property string $dc
 *
 * @property Resume $resume
 * @property Profession $profession
 * @property User $user
 * @property RecStatus $recStatus
 */
class ResumeProfession extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%resume_profession}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['note'], 'filter', 'filter' => 'trim'],
            [['note', 'user_id'], 'default'],
            [['rec_status_id', 'rec_status_id'], 'default', 'value' => 1],
            [['user_id'], 'default', 'value' => Yii::$app->user->id],
            [['resume_id', 'profession_id'], 'required'],
            [['resume_id', 'profession_id', 'rec_status_id', 'user_id'], 'integer'],
            [['note'], 'string'],
            [['dc'], 'safe'],
            ['resume_id', 'exist', 'targetClass' => Resume::className(), 'targetAttribute' => 'id'],
            ['profession_id', 'exist', 'targetClass' => Profession::className(), 'targetAttribute' => 'id'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'resume_id' => Yii::t('app', 'Резюме'),
            'profession_id' => Yii::t('app', 'Профессия'),
            'note' => Yii::t('app', 'Описание'),
            'rec_status_id' => Yii::t('app', 'Состояние записи'),
            'user_id' => Yii::t('app', 'Кем добавлена запись'),
            'dc' => Yii::t('app', 'Когда добавлена запись'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResume()
    {
        return $this->hasOne(Resume::className(), ['id' => 'resume_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfession()
    {
        return $this->hasOne(Profession::className(), ['id' => 'profession_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecStatus()
    {
        return $this->hasOne(RecStatus::className(), ['id' => 'rec_status_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\ResumeProfessionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\ResumeProfessionQuery(get_called_class());
    }
}
