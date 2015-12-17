<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\searches\VacancySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">
        <div class="btn-group">
            <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $model->id], ['title' => 'Редактировать', 'class' => 'btn btn-primary']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-search"></span>', ['view', 'id' => $model->id], ['title' => 'Подробнее', 'class' => 'btn btn-default']) ?>
        </div>
        <span style="float: right">Вакансия #<?= $model->id ?> от <?= Yii::$app->formatter->asDate($model->date) ?></span>
    </div>
    <!-- List group -->
    <ul class="list-group">
        <li class="list-group-item"><strong>Фирма: </strong><?= $model->firm->full_name?$model->firm->full_name:$model->firm->name ?></li>
        <li class="list-group-item"><strong>Должность: </strong><?= $model->profession->name ?></li>
        <li class="list-group-item"><strong>Оклад: </strong><?= $model->salary ?></li>
    </ul>
    <div class="panel-body" style="min-height: 120px">
        <strong>Описание: </strong><?= \yii\helpers\StringHelper::truncate(Html::encode($model->note),250,'...'); ?>
    </div>
</div>
