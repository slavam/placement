<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\VacancySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Vacancies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacancy-index">

    <h1><?php //echo Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class='pull-left'>
        <?= \yii\helpers\Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'Create new'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="clearfix"></div>

    <div>
        <?php \yii\widgets\Pjax::begin(); ?>

        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'col-6 col-sm-6 col-lg-6'],
            'layout' => '<div>{summary}{pager}</div><div>{items}</div>',
            'itemView' => '_item',
//        'itemView' => function ($model, $key, $index, $widget) {
//            return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
//        },
        ]) ?>

        <?php \yii\widgets\Pjax::end(); ?>

    </div>

</div>
