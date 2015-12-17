<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%doc_exam}}".
 *
 * @property integer $id
 * @property integer $person_id
 * @property string $series
 * @property string $num
 * @property string $date
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
class DocExam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%doc_exam}}';
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
            [['person_id', 'rec_status_id', 'user_id'], 'integer'],
            [['date'], 'date', 'format' => 'dd.mm.yyyy'],
            [['note'], 'string'],
            [['series', 'num'], 'string', 'max' => 50],
            [['series'], 'filter', 'filter' => function ($value) {
                return mb_strtoupper($value, "UTF-8");
            }],
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
            'who_give' => Yii::t('app', 'Орган, выдавший документ'),
            'note' => Yii::t('app', 'Примечание'),
            'rec_status_id' => Yii::t('app', 'Состояние записи'),
            'user_id' => Yii::t('app', 'Кем добавлена запись'),
            'dc' => Yii::t('app', 'Когда добавлена запись'),
        ];
    }

    /**
     * Возвращает серию и номер документа в виде строки
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
     * @return \app\models\queries\DocExamQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\DocExamQuery(get_called_class());
    }
}
