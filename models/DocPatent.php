<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%doc_patent}}".
 *
 * @property integer $id
 * @property integer $person_id
 * @property string $num
 * @property string $date
 * @property integer $duration_months
 * @property integer $duration_days
 * @property string $who_give
 * @property string $note
 * @property integer $rec_status_id
 * @property integer $user_id
 * @property string $dc
 *
 * @property Person $person
 * @property User $user
 * @property RecStatus $recStatus
 */
class DocPatent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%doc_patent}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['note', 'who_give', 'duration_months', 'duration_days'], 'filter', 'filter' => 'trim'],
            [['note', 'who_give', 'duration_months', 'duration_days'], 'default'],
            [['rec_status_id'], 'default', 'value' => 1],
            [['user_id'], 'default', 'value' => Yii::$app->user->id],
            [['person_id', 'duration_months', 'duration_days', 'rec_status_id', 'user_id'], 'integer'],
            [['date'], 'date', 'format' => 'dd.mm.yyyy'],
            [['note'], 'string'],
            [['num'], 'string', 'max' => 50],
            [['who_give'], 'string', 'max' => 128],
            [['who_give', 'date'], 'required'],
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
            'num' => Yii::t('app', 'Номер'),
            'date' => Yii::t('app', 'Дата выдачи'),
            'dateEnd' => Yii::t('app', 'Дата окончания'),
            'duration_months' => Yii::t('app', 'Срок действия, мес.'),
            'duration_days' => Yii::t('app', 'Срок действия, дн.'),
            'who_give' => Yii::t('app', 'Орган, выдавший документ'),
            'note' => Yii::t('app', 'Примечание'),
            'rec_status_id' => Yii::t('app', 'Состояние записи'),
            'user_id' => Yii::t('app', 'Кем добавлена запись'),
            'dc' => Yii::t('app', 'Когда добавлена запись'),
        ];
    }

    /**
     * Возвращает дату, по которую действует патент
     * @return string
     */
    public function getDateEnd()
    {
        $time = strtotime($this->date);
        if($this->duration_months>0)
            $time = strtotime("+$this->duration_months month", $time);
        if($this->duration_days>0)
            $time = strtotime("+$this->duration_days day", $time);
        return Yii::$app->formatter->asDate($time);
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->date = $this->date ? Yii::$app->formatter->asDate($this->date, 'php:Y-m-d') : null;
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
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'person_id']);
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
     * @return \app\models\queries\DocPatentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\DocPatentQuery(get_called_class());
    }
}
