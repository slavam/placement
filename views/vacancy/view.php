<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Vacancy */

$this->title = 'Вакансия #'.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vacancies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacancy-view">

    <h1><?php //echo Html::encode($this->title) ?></h1>

    <p class='pull-left'>
        <?= \yii\helpers\Html::a('<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'List'), ['index'], ['class' => 'btn btn-default']) ?>
        <?= \yii\helpers\Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'Create new'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= \yii\helpers\Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= \yii\helpers\Html::a('<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Вы уверены что хотите удалить эту запись?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="clearfix"></div>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'date:date',
            'firm.name',
            'profession.name',
            'salary',
            'note:ntext',
            'workplace.name',
            'recStatus.name',
            'user.name',
            'dc:datetime',
        ],
    ]) ?>

</div>
