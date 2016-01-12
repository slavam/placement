<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $access_token
 * @property string $auth_key
 * @property string $name
 * @property string $email
 * @property string $phone // as role // mwm
 * @property integer $firm_id
 * @property integer $workplace_id
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
 * @property Firm $firm
 * @property Person[] $people
 * @property Profession[] $professions
 * @property RecStatus[] $recStatuses
 * @property Region[] $regions
 * @property Resume[] $resumes
 * @property ResumeProfessions[] $resumeProfessions
 * @property ResumeState[] $resumeStates
 * @property RecState $recState
 * @property User $user
 * @property User[] $users
 * @property Vacancy[] $vacancies
 * @property Workplace $workplace
 * @property Workplace[] $workplaces
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $authKey;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'password', 'name', 'note', 'email', 'phone'], 'filter', 'filter' => 'trim'],
            [['login', 'password', 'name', 'note', 'email', 'phone'], 'default'],
            [['rec_status_id'], 'default', 'value' => 1],
            [['user_id'], 'default', 'value' => Yii::$app->user->id],
            [['login', 'password'], 'required'],
            [['note'], 'string'],
            [['firm_id', 'workplace_id', 'rec_status_id', 'user_id'], 'integer'],
            [['dc'], 'safe'],
            [['login', 'password'], 'string', 'length' => [3, 50]],
            [['name', 'email', 'phone', 'access_token', 'auth_key'], 'string', 'max' => 128],
            ['email','email'],
            [['login'], 'unique'],
            ['name', 'filter', 'filter' => function ($value) {
                if($value=='')
                    return $this->login;
                else
                    return $value;
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'login' => Yii::t('app', 'Логин'),
            'password' => Yii::t('app', 'Пароль'),
            'access_token' => Yii::t('app', 'Токен'),
            'auth_key' => Yii::t('app', 'Ключ'),
            'name' => Yii::t('app', 'Ф.И.О. пользователя'),
            'email' => Yii::t('app', 'Электронная почта'),
            'phone' => Yii::t('app', 'Телефон'),
            'firm_id' => Yii::t('app', 'Фирма-работодатель'),
            'workplace_id' => Yii::t('app', 'Рабочее место'),
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
        return $this->hasMany(Address::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocs()
    {
        return $this->hasMany(Docs::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExperiences()
    {
        return $this->hasMany(Experience::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFirm()
    {
        return $this->hasOne(Firm::className(), ['id' => 'firm_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFirms()
    {
        return $this->hasMany(Firm::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfessions()
    {
        return $this->hasMany(Profession::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecStates()
    {
        return $this->hasMany(RecState::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegions()
    {
        return $this->hasMany(Region::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResumes()
    {
        return $this->hasMany(Resume::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResumeProfessions()
    {
        return $this->hasMany(ResumeProfessions::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResumeStates()
    {
        return $this->hasMany(ResumeState::className(), ['user_id' => 'id']);
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacancies()
    {
        return $this->hasMany(Vacancy::className(), ['user_id' => 'id']);
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
    public function getWorkplaces()
    {
        return $this->hasMany(Workplace::className(), ['user_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\UserQuery(get_called_class());
    }

    /**
     * Finds user by name
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return User::find()->active()->where(['login'=>$username])->one();
    }

    /**
     * Если введено новое значение в поле 'password', то шифруем его в md5
     * перед сохранением в БД
     */
    public function beforeSave($insert)
    {
        if ($this->password !== $this->getOldAttribute('password'))
            $this->password=md5($this->password);

        return parent::beforeSave($insert);
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
}
