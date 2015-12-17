<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%profession}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $note
 * @property integer $rec_status_id
 * @property integer $user_id
 * @property string $dc
 *
 * @property Experience[] $experiences
 * @property User $user
 * @property RecStatus $recStatus
 * @property ResumeProfession[] $resumeProfessions
 */
class Profession extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%profession}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'note'], 'filter', 'filter' => 'trim'],
            [['name', 'note', 'user_id'], 'default'],
            [['rec_status_id'], 'default', 'value' => 1],
            [['user_id'], 'default', 'value' => Yii::$app->user->id],
            [['name'], 'required'],
            [['note'], 'string'],
            [['rec_status_id', 'user_id'], 'integer'],
            [['dc'], 'safe'],
            [['name'], 'string', 'max' => 128],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Наименование профессии'),
            'note' => Yii::t('app', 'Примечание'),
            'rec_status_id' => Yii::t('app', 'Состояние записи'),
            'user_id' => Yii::t('app', 'Кем добавлена запись'),
            'dc' => Yii::t('app', 'Когда добавлена запись'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExperiences()
    {
        return $this->hasMany(Experience::className(), ['profession_id' => 'id']);
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
     * @return \yii\db\ActiveQuery
     */
    public function getResumeProfessions()
    {
        return $this->hasMany(ResumeProfession::className(), ['profession_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\ProfessionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\ProfessionQuery(get_called_class());
    }
}
