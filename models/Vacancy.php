<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%vacancy}}".
 *
 * @property integer $id
 * @property string $date
 * @property integer $firm_id
 * @property integer $profession_id
 * @property string $salary
 * @property string $note
 * @property integer $workplace_id
 * @property integer $rec_status_id
 * @property integer $user_id
 * @property string $dc
 *
 * @property Resume[] $resumes
 * @property Profession $profession
 * @property Workplace $workplace
 * @property User $user
 * @property RecStatus $recStatus
 * @property Firm $firm
 */
class Vacancy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%vacancy}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['note', 'date'], 'filter', 'filter' => 'trim'],
            [['note', 'date', 'user_id'], 'default'],
            [['rec_status_id'], 'default', 'value' => 1],
            [['user_id'], 'default', 'value' => Yii::$app->user->id],
            [['date'], 'default', 'value' => Yii::$app->formatter->asDate(time())],
            [['firm_id', 'profession_id', 'workplace_id'], 'required'],
            [['date'], 'date', 'format' => 'dd.mm.yyyy'],
            [['note'], 'string'],
            [['firm_id', 'profession_id', 'workplace_id', 'rec_status_id', 'user_id'], 'integer'],
            [['dc'], 'safe'],
            [['salary'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->date = $this->date ? Yii::$app->formatter->asDate($this->date,'php:Y-m-d') : null;
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
        $this->date = $this->date ? Yii::$app->formatter->asDate($this->date) : null;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Дата'),
            'firm_id' => Yii::t('app', 'Фирма-работодатель'),
            'profession_id' => Yii::t('app', 'Должность'),
            'salary' => Yii::t('app', 'Зарплата'),
            'note' => Yii::t('app', 'Описание'),
            'workplace_id' => Yii::t('app', 'Рабочее место'),
            'rec_status_id' => Yii::t('app', 'Состояние записи'),
            'user_id' => Yii::t('app', 'Кем добавлена запись'),
            'dc' => Yii::t('app', 'Когда добавлена запись'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResumes()
    {
        return $this->hasMany(Resume::className(), ['vacancy_id' => 'id']);
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
    public function getWorkplace()
    {
        return $this->hasOne(Workplace::className(), ['id' => 'workplace_id']);
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
    public function getFirm()
    {
        return $this->hasOne(Firm::className(), ['id' => 'firm_id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\VacancyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\VacancyQuery(get_called_class());
    }
}
