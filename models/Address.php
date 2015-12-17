<?php

namespace app\models;

use app\models\behaviors\CityBehavior;
use app\models\behaviors\RegionBehavior;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%address}}".
 *
 * @property integer $id
 * @property integer $region_id
 * @property integer $city_id
 * @property string $street
 * @property string $house
 * @property string $room
 * @property string $note
 * @property integer $rec_status_id
 * @property integer $user_id
 * @property string $dc
 *
 * @property Region $region
 * @property City $city
 * @property User $user
 * @property RecStatus $recStatus
 * @property Doc[] $docs
 * @property Firm[] $firms
 * @property Person[] $people
 * @property Workplace[] $workplaces
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%address}}';
    }

    public function behaviors()
    {
        return [
            'CityBehavior' => [
                'class' => CityBehavior::className(),
                'txt' => 'city_name',
                'id_field' => 'city_id',
                'name_field' => 'name',
                'classDir' => City::className(),
            ],
            'RegionBehavior' => [
                'class' => RegionBehavior::className(),
                'txt' => 'region_name',
                'id_field' => 'region_id',
                'name_field' => 'name',
                'classDir' => Region::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_name', 'city_name'], 'required'],
            [['street', 'house', 'room', 'note', 'region_name'], 'filter', 'filter' => 'trim'],
            [['street', 'house', 'room', 'note', 'region_name', 'city_name'], 'default'],
            [['rec_status_id'], 'default', 'value' => 1],
            [['user_id'], 'default', 'value' => Yii::$app->user->id],
            [['note'], 'string'],
            [['region_id', 'city_id', 'rec_status_id', 'user_id'], 'integer'],
            [['dc'], 'safe'],
            [['street'], 'string', 'max' => 50],
            [['house', 'room'], 'string', 'max' => 20],
            ['region_id', 'exist', 'targetClass' => Region::className(), 'targetAttribute' => 'id'],
            ['city_id', 'exist', 'targetClass' => City::className(), 'targetAttribute' => 'id'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'region_name' => Yii::t('app', 'Регион'),
            'city_name' => Yii::t('app', 'Населенный пункт'),
            'fullName' => Yii::t('app', 'Адрес'),
            'linkToParent' => Yii::t('app', 'Кому принадлежит адрес'),
            'id' => Yii::t('app', 'ID'),
            'region_id' => Yii::t('app', 'Регион'),
            'city_id' => Yii::t('app', 'Населенный пункт'),
            'street' => Yii::t('app', 'Улица'),
            'house' => Yii::t('app', 'Дом'),
            'room' => Yii::t('app', 'Квартира'),
            'note' => Yii::t('app', 'Примечание'),
            'rec_status_id' => Yii::t('app', 'Состояние записи'),
            'user_id' => Yii::t('app', 'Кем добавлена запись'),
            'dc' => Yii::t('app', 'Когда добавлена запись'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        $this->city_name = $this->city ? $this->city->name : null;
        $this->region_name = $this->region ? $this->region->name : null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
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
    public function getDocs()
    {
        return $this->hasMany(Doc::className(), ['address_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFirms()
    {
        return $this->hasMany(Firm::className(), ['address_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['address_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkplaces()
    {
        return $this->hasMany(Workplace::className(), ['address_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\queries\AddressQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\queries\AddressQuery(get_called_class());
    }

    /**
     * Возвращает адрес в виде строки
     *
     * @return string
     */
    public function getFullName()
    {
        $val = trim(implode(', ', array_filter([
            $this->region_id ? $this->region->name : null,
            $this->city_id ? $this->city->name : null,
            $this->street ? $this->street : null,
            $this->house ? 'д.' . $this->house : null,
            $this->room ? 'кв.' . $this->room : null,
        ])));
        return $val ? $val : null;
//        return ($val!=='')?$val:null;
    }

    /**
     * Возвращает ссылку на владельца адреса
     *
     * @return string
     */
    public function getLinkToParent()
    {
        foreach ($this->firms as $firm) {
            return 'Адрес принадлежит фирме ' . Html::a('"' . $firm->name . '"', ['/firm/view', 'id' => $firm->id], ['class' => '', 'title' => 'Перейти']);
        }
        foreach ($this->workplaces as $workplace) {
            return 'Адрес принадлежит рабочему месту ' . Html::a('"' . $workplace->name . '"', ['/workplace/view', 'id' => $workplace->id], ['class' => '', 'title' => 'Перейти']);
        }
//            foreach ($this->people as $person){
//                return 'Адрес принадлежит человеку '.Html::a(''.$person->fullName.'', ['/person/view', 'id' => $person->id], ['class'=>'', 'title'=>'Перейти']);
//            }
    }

}
