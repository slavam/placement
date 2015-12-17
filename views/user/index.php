<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?php //echo Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class='pull-left'>
        <?= \yii\helpers\Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'Create new'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="clearfix"></div>


    <?php \yii\widgets\Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'login',
//            'password',
//            'access_token',
//            'auth_key',
             'name',
             'email:email',
             'phone',
            // 'firm_id',
             'note:ntext',
            // 'rec_status_id',
            // 'user_id',
            // 'dc:datetime',

            ['class' => 'yii\grid\ActionColumn', 'contentOptions' => ['style' => 'white-space: nowrap;']],
        ],
        'tableOptions' =>['class' => 'table table-striped table-hover'],
    ]); ?>

    <?php \yii\widgets\Pjax::end(); ?>

</div>
