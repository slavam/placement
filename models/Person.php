<?php

namespace app\models;

use app\models\behaviors\AddressBehavior;
use Yii;

/**
 * This is the model class for table "{{%person}}".
 *
 * @property integer $id
 * @property string $lname
 * @property string $fname
 * @property string $mname
 * @property string $birthday
 * @property integer $sex
 * @property integer $address_id
 * @property string $email
 * @property string $phone
 * @property string $note
 * @property integer $rec_status_id
 * @property integer $user_id
 * @property string $dc
 *
 * @property Experience[] $experiences
 * @property Education[] $educations
 * @property Doc[] $docs
 * @property Address $address
 * @property User $user
 * @property RecStatus $recStatus
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * Список пола человека
     * @var array
     */
    public static $list_sex = [1 => 'М', 2 => 'Ж'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%person}}';
    }

    public function behaviors()
    {
        return [
            'AddressBehavior' => [
                'class' => AddressBehavior::className(),
//                'txt' => '',
                'id_field' => 'address_id',
//                'name_field' => '',
                'classDir' => Address::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lname', 'fname', 'mname', 'email', 'phone', 'birthday', 'note'], 'filter', 'filter' => 'trim'],
            [['lname', 'fname', 'mname', 'email', 'phone', 'birthday', 'note'], 'default'],
            [['rec_status_id'], 'default', 'value' => 1],
            [['user_id'], 'default', 'value' => Yii::$app->user->id],
            [['lname', 'fname', 'sex'], 'required'],
            [['birthday'], 'date', 'format' => 'dd.mm.yyyy'],
            [['birthday', 'dc'], 'safe'],
            [['sex', 'address_id', 'rec_status_id', 'user_id'], 'integer'],
            [['note'], 'string'],
            [['email'], 'email'],
            [['lname', 'fname', 'mname', 'email', 'phone'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fullName' => Yii::t('app', 'Ф.И.О.'),
            'id' => Yii::t('app', 'ID'),
            'lname' => Yii::t('app', 'Фамилия'),
            'fname' => Yii::t('app', 'Имя'),
            'mname' => Yii::t('app', 'Отчество'),
            'birthday' => Yii::t('app', 'Дата рождения'),
            'sex' => Yii::t('app', 'Пол'),
            'sexName' => Yii::t('app', 'Пол'),
            'address_id' => Yii::t('app', 'Адрес'),
            'email' => Yii::t('app', 'Электронная почта'),
            'phone' => Yii::t('app', 'Телефон'),
            'note' => Yii::t('app', 'Примечание'),
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
            $this->birthday = $this->birthday ? Yii::$app->formatter->asDate($this->birthday, 'php:Y-m-d') : null;
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
        $this->birthday = $this->birthday ? Yii::$app->formatter->asDate($this->birthday) : null;
    }

    /**
     * Возвращает ФИО человека
     *
     * @return string
     */
    public function getFullName()
    {
        $val = trim(implode(' ', array_filter([
            $this->lname,
            $this->fname,
            $this->mname,
        ])));
        return $val ? $val : null;
//        return ($val!=='')?$val:null;
    }

    /**
     * Возвращает текстовое значение пола человека
     *
     * @return string
     */
    public function getSexName()
    {
        if (isset(self::$list_sex[$this->sex]))
            return self::$list_sex[$this->sex];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExperiences()
    {
        return $this->hasMany(Experience::className(), ['person_id' => 'id'])->orderBy('date_start');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEducations()
    {
        return $this->hasMany(Education::className(), ['person_id' => 'id'])->orderBy('date_start');
    }

    /**
     * @param null $type_id
     * @return \yii\db\ActiveQuery
     */
    public function getDocs($type_id = null)
    {
        if ($type_id !== null)
            return $this->hasMany(Doc::className(), ['person_id' => 'id'])->where('type_id=' . $type_id);

        return $this->hasMany(Doc::className(), ['person_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocsCount()
    {
        return $this->getPasport()->count()
        + $this->getMedical()->count()
        + $this->getInn()->count()
        + $this->getPatent()->count()
        + $this->getExam()->count()
        + $this->getMigration()->count()
        + $this->getRegistration()->count()
        + 0;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::className(), ['rec_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMigration()
    {
        return $this->hasMany(DocMigration::className(), ['person_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegistration()
    {
        return $this->hasMany(DocRegistration::className(), ['person_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExam()
    {
        return $this->hasMany(DocExam::className(), ['person_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatent()
    {
        return $this->hasMany(DocPatent::className(), ['person_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedical()
    {
        return $this->hasMany(DocMedical::className(), ['person_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPasport()
    {
        return $this->hasMany(DocPassport::className(), ['person_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInn()
    {
        return $this->hasMany(DocInn::className(), ['person_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
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
     * @return \app\models\queries\PersonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\PersonQuery(get_called_class());
    }
}
