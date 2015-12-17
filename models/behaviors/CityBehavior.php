<?php

namespace app\models\behaviors;

use app\components\BasicBehavior;

class CityBehavior extends BasicBehavior
{
    public $city_name;

    /**
     * @var array
     */
    public $rules = [
        ['city_name', 'filter', 'filter' => 'trim'],
        ['city_name', 'default'],
        ['city_name', 'safe'],
    ];
}