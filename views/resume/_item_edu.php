<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\searches\EducationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">
        <div class="btn-group">
            <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['/education/update', 'id' => $model->id], ['title' => 'Редактировать', 'class' => 'btn btn-primary']) ?>
            <?= \yii\helpers\Html::a('<span class="glyphicon glyphicon-trash"></span>', ['/education/delete', 'id' => $model->id], [
                'title' => 'Удалить',
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Вы уверены что хотите удалить эту запись?'),
                    'method' => 'post',
                ],
            ]) ?>
        </div>
        <span style="float: right"><?php //echo $model->profession->name ?></span>
    </div>
    <!-- List group -->
    <ul class="list-group">
        <li class="list-group-item"><strong><?= $model->getAttributeLabel('firm') ?> : </strong><?= $model->firm ?></li>
<!--        <li class="list-group-item"><strong><?/*= $model->getAttributeLabel('city_id') */?> : </strong><?/*= $model->city?$model->city->name:null */?></li>-->
        <li class="list-group-item"><strong><?= $model->getAttributeLabel('profession_id') ?> : </strong><?= $model->profession->name ?></li>
        <li class="list-group-item"><strong><?= $model->getAttributeLabel('date_start') ?> : </strong><?= $model->date_start ?></li>
        <li class="list-group-item"><strong><?= $model->getAttributeLabel('date_end') ?> : </strong><?= $model->date_end ?></li>
        <li class="list-group-item"><strong><?= $model->getAttributeLabel('duration') ?> : </strong><?= $model->duration ?></li>
    </ul>
    <div class="panel-body">
        <strong>Описание: </strong><?= Html::encode($model->note); ?>
    </div>
</div>
