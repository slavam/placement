<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%experience}}".
 *
 * @property integer $id
 * @property integer $type_id
 * @property integer $person_id
 * @property integer $education_type_id
 * @property string $firm
 * @property integer $profession_id
 * @property integer $city_id
 * @property string $date_start
 * @property string $date_end
 * @property integer $duration
 * @property string $note
 * @property integer $rec_status_id
 * @property integer $user_id
 * @property string $dc
 *
 * @property Person $person
 * @property City $city
 * @property Profession $profession
 * @property User $user
 * @property RecStatus $recStatus
 */
class Education extends Experience
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'person_id', 'education_type_id', 'profession_id', 'city_id', 'duration', 'rec_status_id', 'user_id'], 'integer'],
            [['date_start', 'date_end'], 'date', 'format' => 'dd.mm.yyyy'],
            [['education_type_id', 'person_id', 'firm', 'profession_id'], 'required'],
            [['firm'], 'string', 'max' => 128],
            [['type_id'], 'default', 'value' => 1],
            [['rec_status_id'], 'default', 'value' => 1],
            [['user_id'], 'default', 'value' => Yii::$app->user->id],
            [['note'], 'string'],
            [['dc'], 'safe'],
            ['person_id', 'exist', 'targetClass' => Person::className(), 'targetAttribute' => 'id'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type_id' => Yii::t('app', 'Тип опыта'),
            'typeName' => Yii::t('app', 'Тип опыта'),
            'person_id' => Yii::t('app', 'Человек'),
            'education_type_id' => Yii::t('app', 'Уровень образования'),
            'educationTypeName' => Yii::t('app', 'Уровень образования'),
            'firm' => Yii::t('app', 'Учебное заведение'),
            'profession_id' => Yii::t('app', 'Профессия'),
            'city_id' => Yii::t('app', 'Населенный пункт'),
            'date_start' => Yii::t('app', 'Дата с'),
            'date_end' => Yii::t('app', 'Дата по'),
            'duration' => Yii::t('app', 'Продолжительность, дней'),
            'note' => Yii::t('app', 'Примечание'),
            'rec_status_id' => Yii::t('app', 'Состояние записи'),
            'user_id' => Yii::t('app', 'Кем добавлена запись'),
            'dc' => Yii::t('app', 'Когда добавлена запись'),
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\EducationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\EducationQuery(get_called_class());
    }
}
