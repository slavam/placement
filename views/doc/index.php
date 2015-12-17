<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\DocSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Docs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doc-index">

    <h1><?php //echo Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'Create new'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php \yii\widgets\Pjax::begin(); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'person_id',
            'person.fullName',
            [
                'attribute' => 'type_id',
                'value' => 'typeName',
                'filter' => \app\models\Doc::$list_type,
            ],
            'name',
            'series',
            'num',
            // 'date',
            // 'date_end',
            // 'date_renewal',
            // 'duration_months',
            // 'duration_days',
            // 'who_give',
            // 'address_id',
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
            // 'dc',

            ['class' => 'yii\grid\ActionColumn', 'contentOptions' => ['style' => 'white-space: nowrap;']],
        ],
        'tableOptions' => ['class' => 'table table-striped table-hover'],
    ]); ?>

    <?php \yii\widgets\Pjax::end(); ?>

</div>
