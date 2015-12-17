<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%rec_status}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $note
 * @property integer $rec_status_id
 * @property integer $user_id
 * @property string $dc
 *
 * @property Address[] $addresses
 * @property City[] $cities
 * @property Docs[] $docs
 * @property Experience[] $experiences
 * @property Files[] $files
 * @property Firm[] $firms
 * @property Person[] $people
 * @property Profession[] $professions
 * @property User $user
 * @property RecStatus $recStatus
 * @property RecStatus[] $recStatuses
 * @property Region[] $regions
 * @property Resume[] $resumes
 * @property ResumeProfessions[] $resumeProfessions
 * @property ResumeState[] $resumeStates
 * @property User[] $users
 * @property Vacancy[] $vacancies
 * @property Workplace[] $workplaces
 */
class RecStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rec_status}}';
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
            'name' => Yii::t('app', 'Состояние записи'),
            'note' => Yii::t('app', 'Примечание'),
            'rec_status_id' => Yii::t('app', 'Состояние записи'),
            'user_id' => Yii::t('app', 'Кем добавлена запись'),
            'dc' => Yii::t('app', 'Когда добавлена запись'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['rec_status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['rec_status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocs()
    {
        return $this->hasMany(Docs::className(), ['rec_status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExperiences()
    {
        return $this->hasMany(Experience::className(), ['rec_status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['rec_status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFirms()
    {
        return $this->hasMany(Firm::className(), ['rec_status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['rec_status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfessions()
    {
        return $this->hasMany(Profession::className(), ['rec_status_id' => 'id']);
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
    public function getRecStatuses()
    {
        return $this->hasMany(RecStatus::className(), ['rec_status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegions()
    {
        return $this->hasMany(Region::className(), ['rec_status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResumes()
    {
        return $this->hasMany(Resume::className(), ['rec_status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResumeProfessions()
    {
        return $this->hasMany(ResumeProfessions::className(), ['rec_status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResumeStates()
    {
        return $this->hasMany(ResumeState::className(), ['rec_status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['rec_status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacancies()
    {
        return $this->hasMany(Vacancy::className(), ['rec_status_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkplaces()
    {
        return $this->hasMany(Workplace::className(), ['rec_status_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\RecStatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\RecStatusQuery(get_called_class());
    }
}
