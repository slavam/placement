<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DocRegistration */
/* @var $address app\models\Address */

$this->title = Yii::t('app', 'Updating') . ' ' . $model->getFullNum();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Registration'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->getFullNum(), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Updating');
?>
<div class="doc-inn-update">

    <h1><?php //echo Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> ' .Yii::t('app', 'List'), ['index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' .Yii::t('app', 'Create new'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> ' .Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
        'confirm' => Yii::t('app', 'Вы уверены что хотите удалить эту запись?'),
        'method' => 'post',
        ],
        ]) ?>
    </p>

    <?= $this->render('_form', [
        'model' => $model,
        'address' => $address,
    ]) ?>

</div>
