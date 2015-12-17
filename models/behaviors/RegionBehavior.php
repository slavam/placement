<?php

namespace app\models\behaviors;

use app\components\BasicBehavior;

class RegionBehavior extends BasicBehavior
{
    public $region_name;

    /**
     * @var array
     */
    public $rules = [
        ['region_name', 'filter', 'filter' => 'trim'],
        ['region_name', 'default'],
        ['region_name', 'safe'],
    ];
}