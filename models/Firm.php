<?php

namespace app\models;

use app\models\behaviors\AddressBehavior;
use Yii;

/**
 * This is the model class for table "{{%firm}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $full_name
 * @property string $okpo
 * @property integer $address_id
 * @property string $director
 * @property string $email
 * @property string $phone
 * @property string $bank_name
 * @property string $bank_mfo
 * @property string $bank_rs
 * @property string $svid_num
 * @property string $svid_date
 * @property string $svid_who_give
 * @property string $note
 * @property integer $rec_status_id
 * @property integer $user_id
 * @property string $dc
 *
 * @property Address $address
 * @property User $user
 * @property RecStatus $recStatus
 */
class Firm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%firm}}';
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
            [['name', 'full_name', 'okpo', 'director', 'email', 'phone', 'bank_name', 'bank_mfo', 'bank_rs', 'svid_num', 'svid_date', 'svid_who_give', 'note'], 'filter', 'filter' => 'trim'],
            [['name', 'full_name', 'okpo', 'director', 'email', 'phone', 'bank_name', 'bank_mfo', 'bank_rs', 'svid_num', 'svid_date', 'svid_who_give', 'note', 'address_id'], 'default'],
            [['rec_status_id'], 'default', 'value' => 1],
            [['user_id'], 'default', 'value' => Yii::$app->user->id],
            [['name'], 'required'],
            [['note'], 'string'],
            [['address_id', 'rec_status_id', 'user_id'], 'integer'],
            [['svid_date'], 'date', 'format' => 'dd.mm.yyyy'],
            [['svid_date', 'dc'], 'safe'],
            [['name', 'full_name', 'director', 'email', 'phone', 'bank_name', 'svid_who_give'], 'string', 'max' => 128],
            [['okpo', 'bank_rs', 'svid_num'], 'string', 'max' => 20],
            [['bank_mfo'], 'string', 'max' => 10],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->svid_date = $this->svid_date ? Yii::$app->formatter->asDate($this->svid_date,'php:Y-m-d') : null;
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
        $this->svid_date = $this->svid_date ? Yii::$app->formatter->asDate($this->svid_date) : null;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Наименование предприятия'),
            'full_name' => Yii::t('app', 'Полное наименование предприятия'),
            'okpo' => Yii::t('app', 'Код предприятия'),
            'address_id' => Yii::t('app', 'Адрес'),
            'director' => Yii::t('app', 'Директор'),
            'email' => Yii::t('app', 'Электронная почта'),
            'phone' => Yii::t('app', 'Телефон'),
            'bank_name' => Yii::t('app', 'Наименование банка'),
            'bank_mfo' => Yii::t('app', 'МФО банка'),
            'bank_rs' => Yii::t('app', 'Р/с'),
            'svid_num' => Yii::t('app', 'Номер свидетельства налогоплательщика'),
            'svid_date' => Yii::t('app', 'Дата выдачи свидетельства'),
            'svid_who_give' => Yii::t('app', 'Орган, выдавший свидетельство'),
            'note' => Yii::t('app', 'Примечание'),
            'rec_status_id' => Yii::t('app', 'Состояние записи'),
            'user_id' => Yii::t('app', 'Кем добавлена запись'),
            'dc' => Yii::t('app', 'Когда добавлена запись'),
        ];
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
     * @return \app\models\queries\FirmQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\FirmQuery(get_called_class());
    }
}
