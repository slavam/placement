<?php

namespace app\models;

use app\models\behaviors\AddressBehavior;
use Yii;

/**
 * This is the model class for table "{{%workplace}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $address_id
 * @property string $email
 * @property string $phone
 * @property string $note
 * @property integer $rec_status_id
 * @property integer $user_id
 * @property string $dc
 *
 * @property Resume[] $resumes
 * @property Vacancy[] $vacancies
 * @property Address $address
 * @property User $user
 * @property RecStatus $recStatus
 */
class Workplace extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%workplace}}';
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
            [['name', 'note', 'email', 'phone'], 'filter', 'filter' => 'trim'],
            [['name', 'note', 'user_id'], 'default'],
            [['rec_status_id'], 'default', 'value' => 1],
            [['user_id'], 'default', 'value' => Yii::$app->user->id],
            [['name'], 'required'],
            [['note'], 'string'],
            [['address_id', 'rec_status_id', 'user_id'], 'integer'],
            [['dc'], 'safe'],
            [['name', 'email', 'phone'], 'string', 'max' => 128],
            ['email', 'email'],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Рабочее место'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getResumes()
    {
        return $this->hasMany(Resume::className(), ['workplace_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVacancies()
    {
        return $this->hasMany(Vacancy::className(), ['workplace_id' => 'id']);
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
     * @return \app\models\queries\WorkplaceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\WorkplaceQuery(get_called_class());
    }
}
