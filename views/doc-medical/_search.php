<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\searches\DocMedicalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doc-medical-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'person_id') ?>

    <?= $form->field($model, 'num') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'duration_months') ?>

    <?php // echo $form->field($model, 'duration_days') ?>

    <?php // echo $form->field($model, 'who_give') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'rec_status_id') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'dc') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
