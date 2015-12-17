<?php

namespace app\models;

use app\models\behaviors\AddressBehavior;
use Yii;

/**
 * This is the model class for table "{{%doc_registration}}".
 *
 * @property integer $id
 * @property integer $person_id
 * @property string $series
 * @property string $num
 * @property string $date
 * @property string $date_end
 * @property string $date_renewal
 * @property string $who_give
 * @property integer $address_id
 * @property string $note
 * @property integer $rec_status_id
 * @property integer $user_id
 * @property string $dc
 *
 * @property Person $person
 * @property Address $address
 * @property User $user
 * @property RecStatus $recStatus
 */
class DocRegistration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%doc_registration}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['series', 'num', 'note', 'who_give'], 'filter', 'filter' => 'trim'],
            [['series', 'num', 'note', 'who_give'], 'default'],
            [['rec_status_id'], 'default', 'value' => 1],
            [['user_id'], 'default', 'value' => Yii::$app->user->id],
            [['person_id', 'address_id', 'rec_status_id', 'user_id'], 'integer'],
            [['date', 'date_end', 'date_renewal'], 'date', 'format' => 'dd.mm.yyyy'],
            [['note'], 'string'],
            [['series', 'num'], 'string', 'max' => 50],
            [['series'], 'filter', 'filter' => function ($value) {
                return mb_strtoupper($value, "UTF-8");
            }],
            [['dc'], 'safe'],
            [['who_give'], 'string', 'max' => 128],
            [['series', 'num', 'who_give', 'date'], 'required'],
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
            'person_id' => Yii::t('app', 'Владелец'),
            'series' => Yii::t('app', 'Серия'),
            'num' => Yii::t('app', 'Номер'),
            'date' => Yii::t('app', 'Дата выдачи'),
            'date_end' => Yii::t('app', 'Дата окончания'),
            'date_renewal' => Yii::t('app', 'Дата продления'),
            'who_give' => Yii::t('app', 'Орган, выдавший документ'),
            'address_id' => Yii::t('app', 'Адрес'),
            'note' => Yii::t('app', 'Примечание'),
            'rec_status_id' => Yii::t('app', 'Состояние записи'),
            'user_id' => Yii::t('app', 'Кем добавлена запись'),
            'dc' => Yii::t('app', 'Когда добавлена запись'),
        ];
    }

    /**
     * Возвращает серию и номер паспорта в виде строки
     *
     * @return string
     */
    public function getFullNum()
    {
        $val = trim(implode(' ', array_filter([
            $this->series,
            $this->num,
        ])));
        return $val ? $val : null;
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->date = $this->date ? Yii::$app->formatter->asDate($this->date, 'php:Y-m-d') : null;
            $this->date_end = $this->date_end ? Yii::$app->formatter->asDate($this->date_end, 'php:Y-m-d') : null;
            $this->date_renewal = $this->date_renewal ? Yii::$app->formatter->asDate($this->date_renewal, 'php:Y-m-d') : null;
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
        $this->date_end = $this->date_end ? Yii::$app->formatter->asDate($this->date_end) : null;
        $this->date_renewal = $this->date_renewal ? Yii::$app->formatter->asDate($this->date_renewal) : null;
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
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'person_id']);
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
     * @return \app\models\queries\DocRegistrationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\DocRegistrationQuery(get_called_class());
    }
}
