<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%file}}".
 *
 * @property integer $id
 * @property string $table_name
 * @property string $class_name
 * @property integer $rec_id
 * @property integer $type_id
 * @property string $file_name
 * @property string $file_path
 * @property string $note
 * @property integer $rec_status_id
 * @property integer $user_id
 * @property string $dc
 *
 * @property User $user
 * @property RecStatus $recStatus
 */
class File extends \yii\db\ActiveRecord
{
    public $files;

    /**
     * Список типов документов
     * @var array
     */
    public static $list_type = [
        10 => 'Паспорт',
        20 => 'ИНН',
        30 => 'Фото',
        40 => 'Трудовая книжка',
        50 => 'Диплом',
        60 => 'Миграционная карта',
        70 => 'Регистрация',
        80 => 'Мед. осмотр',
        90 => 'Патент на работу',
        100 => 'Экзамен',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%file}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['table_name', 'class_name', 'file_name', 'note'], 'filter', 'filter' => 'trim'],
            [['table_name', 'class_name', 'file_name', 'note', 'user_id'], 'default'],
            [['rec_status_id'], 'default', 'value' => 1],
            [['user_id'], 'default', 'value' => Yii::$app->user->id],
            [['rec_id', 'type_id', 'rec_status_id', 'user_id'], 'integer'],
            [['note'], 'string'],
            [['rec_id', 'type_id'], 'required'],
            [['dc'], 'safe'],
            [['table_name', 'class_name', 'file_name'], 'string', 'max' => 50],
            [['file_path'], 'string', 'max' => 128],

            [['files'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'files' => Yii::t('app', 'Файл'),
            'id' => Yii::t('app', 'ID'),
            'table_name' => Yii::t('app', 'Имя таблицы'),
            'class_name' => Yii::t('app', 'Имя модели'),
            'rec_id' => Yii::t('app', 'ID записи'),
            'type_id' => Yii::t('app', 'Тип файла'),
            'file_name' => Yii::t('app', 'Название файла'),
            'file_path' => Yii::t('app', 'Местоположение файла'),
            'note' => Yii::t('app', 'Примечание'),
            'rec_status_id' => Yii::t('app', 'Состояние записи'),
            'user_id' => Yii::t('app', 'Кем добавлена запись'),
            'dc' => Yii::t('app', 'Когда добавлена запись'),
        ];
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
     * @return \app\models\queries\FileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\FileQuery(get_called_class());
    }
}
