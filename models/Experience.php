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
class Experience extends \yii\db\ActiveRecord
{
    /**
     * Список типов опыта
     * @var array
     */
    public static $list_type = [1 => 'Образование', 2 => 'Работа'];

    /**
     * Список типов образования
     * @var array
     */
    public static $list_education_type = [1 => 'Высшее', 2 => 'Среднеспециальное', 3 => 'Среднее'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%experience}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'person_id', 'education_type_id', 'profession_id', 'city_id', 'duration', 'rec_status_id', 'user_id'], 'integer'],
            [['date_start', 'date_end'], 'date', 'format' => 'dd.mm.yyyy'],
            [[/*'education_type_id', 'type_id', */'person_id', 'firm', 'profession_id'], 'required'],
            [['firm'], 'string', 'max' => 128],
            [['type_id'], 'default', 'value' => 2],
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
//            'firm' => Yii::t('app', 'Компания/Учебное заведение'),
            'firm' => Yii::t('app', 'Компания'),
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
     * Возвращает текстовое значение типа опыта
     *
     * @return string
     */
    public function getTypeName()
    {
        if(isset(self::$list_type[$this->type_id]))
            return self::$list_type[$this->type_id];
    }

    /**
     * Возвращает текстовое значение типа опыта
     *
     * @return string
     */
    public function getEducationTypeName()
    {
        if(isset(self::$list_education_type[$this->education_type_id]))
            return self::$list_education_type[$this->education_type_id];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->date_start = $this->date_start ? Yii::$app->formatter->asDate($this->date_start,'php:Y-m-d') : null;
            $this->date_end = $this->date_end ? Yii::$app->formatter->asDate($this->date_end,'php:Y-m-d') : null;
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        $this->date_start = $this->date_start ? Yii::$app->formatter->asDate($this->date_start) : null;
        $this->date_end = $this->date_end ? Yii::$app->formatter->asDate($this->date_end) : null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
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
     * @return \app\models\queries\ExperienceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\ExperienceQuery(get_called_class());
    }
}
