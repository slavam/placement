<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%resume}}".
 *
 * @property integer $id
 * @property integer $person_id
 * @property string $salary
 * @property integer $vacancy_id
 * @property string $date_start
 * @property string $date_end
 * @property string $note
 * @property integer $resume_status_id
 * @property integer $workplace_id
 * @property integer $rec_status_id
 * @property integer $user_id
 * @property string $dc
 *
 * @property ResumeStatus $resumeStatus
 * @property Person $person
 * @property Vacancy $vacancy
 * @property Workplace $workplace
 * @property User $user
 * @property RecStatus $recStatus
 * @property Profession[] $professions
 * @property ResumeProfession[] $resumeProfessions
 * @property string $professionNames
 */
class Resume extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%resume}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['note', 'date_start', 'date_end'], 'filter', 'filter' => 'trim'],
            [['note', 'date_start', 'date_end', 'user_id'], 'default'],
            [['rec_status_id', 'resume_status_id'], 'default', 'value' => 1],
            [['user_id'], 'default', 'value' => Yii::$app->user->id],
            [['date_start', 'date_end'], 'date', 'format' => 'dd.mm.yyyy'],
            [['workplace_id'], 'required'],
//            [['person_id'], 'required', 'on' => 'update'],
//            [['person_id'], 'required'],
            [['person_id', 'vacancy_id', 'resume_status_id', 'workplace_id', 'rec_status_id', 'user_id'], 'integer'],
            [['salary'], 'number'],
            [['resumeProfessions','professions', 'date_start', 'date_end', 'dc'], 'safe'],
            [['note'], 'string'],
            ['person_id', 'exist', 'targetClass' => Person::className(), 'targetAttribute' => 'id'],
            // ['profession_id', 'exist', 'targetClass' => ResumeProfession::className(), 'targetAttribute' => 'profession_id'],
        ];
    }

//    public function scenarios()
//    {
//        $scenarios = parent::scenarios();
//        $scenarios['create'] = ['salary', 'person_id', 'vacancy_id', 'resume_status_id', 'workplace_id', 'rec_status_id', 'user_id'];
//        return $scenarios;
//    }
//
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'professionNames' => Yii::t('app', 'Желаемые должности'),
            'resumeProfessions' => Yii::t('app', 'Желаемые Должности'),
            'professions' => Yii::t('app', 'Желаемые должности'),
            'id' => Yii::t('app', 'ID'),
            'person_id' => Yii::t('app', 'Соискатель'),
            'salary' => Yii::t('app', 'Зарплата'),
            'vacancy_id' => Yii::t('app', 'Подобранная вакансия'),
            'date_start' => Yii::t('app', 'Дата трудоустройства'),
            'date_end' => Yii::t('app', 'Трудоустроен до'),
            'note' => Yii::t('app', 'Описание'),
            'resume_status_id' => Yii::t('app', 'Статус резюме'),
            'workplace_id' => Yii::t('app', 'Рабочее место'),
            'rec_status_id' => Yii::t('app', 'Состояние записи'),
            'user_id' => Yii::t('app', 'Кем добавлена запись'),
            'dc' => Yii::t('app', 'Когда добавлена запись'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->date_start = $this->date_start ? Yii::$app->formatter->asDate($this->date_start, 'php:Y-m-d') : null;
            $this->date_end = $this->date_end ? Yii::$app->formatter->asDate($this->date_end, 'php:Y-m-d') : null;
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
     * @param bool $insert
     * @param array $changedAttributes
     *
     * Сохранение должностей
     */
    public function afterSave($insert, $changedAttributes)
    {
        if (!$insert) {
            ResumeProfession::deleteAll(['resume_id' => $this->id]);
        }
        if (is_array($this->professions)) {
            foreach ($this->professions as $prof) {
                $profLink = new ResumeProfession();
                $profLink->resume_id = $this->id;
                $profLink->profession_id = $prof;
                $profLink->save();
            }
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfessionNames()
    {
        $values = [];
        foreach ($this->professions as $profession) {
            $values[] = $profession->name;
        }
        return implode(', ', $values);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResumeStatus()
    {
        return $this->hasOne(ResumeStatus::className(), ['id' => 'resume_status_id']);
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
    public function getVacancy()
    {
        return $this->hasOne(Vacancy::className(), ['id' => 'vacancy_id']);
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
    public function getResumeProfessions()
    {
        return $this->hasMany(ResumeProfession::className(), ['resume_id' => 'id']);
    }
    
    public function setResumeProfessions($resumeProfessions)
    {
        $this->resumeProfessions = $resumeProfessions;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfessions()
    {
        return $this->hasMany(Profession::className(), ['id' => 'profession_id'])->viaTable(ResumeProfession::tableName(), ['resume_id' => 'id']);
    }

    public function setProfessions($professions)
    {
        $this->professions = $professions;
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\ResumeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\ResumeQuery(get_called_class());
    }
}
