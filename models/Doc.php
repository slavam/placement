<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%doc}}".
 *
 * @property integer $id
 * @property integer $person_id
 * @property integer $type_id
 * @property string $name
 * @property string $series
 * @property string $num
 * @property string $date
 * @property string $date_end
 * @property string $date_renewal
 * @property integer $duration_months
 * @property integer $duration_days
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
class Doc extends \yii\db\ActiveRecord
{
    /**
     * Список типов документов
     * @var array
     */
    public static $list_type = [
        10 => 'Паспорт',
        20 => 'ИНН',
        30 => 'Мед. осмотр',
        40 => 'Патент на работу',
        50 => 'Экзамен',
        60 => 'Миграционная карта',
        70 => 'Регистрация',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%doc}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'type_id', 'duration_months', 'duration_days', 'address_id', 'rec_status_id', 'user_id'], 'integer'],
            [['date', 'date_end', 'date_renewal', 'dc'], 'safe'],
            [['note'], 'string'],
            [['rec_status_id'], 'default', 'value' => 1],
            [['user_id'], 'default', 'value' => Yii::$app->user->id],
//            [['user_id'], 'required'],
            [['name', 'series', 'num'], 'string', 'max' => 50],
            [['who_give'], 'string', 'max' => 128]
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
            'type_id' => Yii::t('app', 'Тип документа'),
            'typeName' => Yii::t('app', 'Тип документа'),
            'name' => Yii::t('app', 'Наименование документа'),
            'series' => Yii::t('app', 'Серия'),
            'num' => Yii::t('app', 'Номер'),
            'date' => Yii::t('app', 'Дата выдачи'),
            'date_end' => Yii::t('app', 'Дата окончания'),
            'date_renewal' => Yii::t('app', 'Дата продления'),
            'duration_months' => Yii::t('app', 'Срок действия, мес.'),
            'duration_days' => Yii::t('app', 'Срок действия, дн.'),
            'who_give' => Yii::t('app', 'Орган, выдавший документ'),
            'address_id' => Yii::t('app', 'Адрес'),
            'note' => Yii::t('app', 'Примечание'),
            'rec_status_id' => Yii::t('app', 'Состояние записи'),
            'user_id' => Yii::t('app', 'Кем добавлена запись'),
            'dc' => Yii::t('app', 'Когда добавлена запись'),
        ];
    }

    /**
     * Возвращает текстовое значение типа документа
     *
     * @return string
     */
    public function getTypeName()
    {
        if (isset(self::$list_type[$this->type_id]))
            return self::$list_type[$this->type_id];
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
     * @return \app\models\queries\DocQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\DocQuery(get_called_class());
    }
}
