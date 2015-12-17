<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\searches\FirmSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="firm-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'full_name') ?>

    <?= $form->field($model, 'okpo') ?>

    <?= $form->field($model, 'address_id') ?>

    <?php // echo $form->field($model, 'director') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'bank_name') ?>

    <?php // echo $form->field($model, 'bank_mfo') ?>

    <?php // echo $form->field($model, 'bank_rs') ?>

    <?php // echo $form->field($model, 'svid_num') ?>

    <?php // echo $form->field($model, 'svid_date') ?>

    <?php // echo $form->field($model, 'svid_who_give') ?>

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
