<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\PersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'People');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-index">

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
            'lname',
            'fname',
            'mname',
            'birthday',
            'sex' => [
                'attribute' => 'sex',
                'value' => 'sexName',
                'filter' => \app\models\Person::$list_sex,
            ],
            // 'address_id',
            'email:email',
            'phone',
            // 'note:ntext',
//            'rec_status_id' => [
//                'attribute'=>'rec_status_id',
//                'value'=>'recStatus.name',
//                'filter'=>ArrayHelper::map(\app\models\RecStatus::find()->active()->all(), 'id', 'name'),
//            ],
//            'user_id' => [
//                'attribute'=>'user_id',
//                'value'=>'user.name',
//                'filter'=>ArrayHelper::map(\app\models\User::find()->active()->all(), 'id', 'name'),
//            ],
            // 'dc:datetime',

            ['class' => 'yii\grid\ActionColumn', 'contentOptions' => ['style' => 'white-space: nowrap;']],
        ],
        'tableOptions' => ['class' => 'table table-striped table-hover'],
    ]); ?>

    <?php \yii\widgets\Pjax::end(); ?>

</div>

