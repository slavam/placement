<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Resume */
/* @var $form yii\widgets\ActiveForm */
?>

<?= $form->field($model, 'date_start')->widget(
    \dosamigos\datepicker\DatePicker::className(), [
        'language' => 'ru',
        'options' => [
            'class' => 'form-control',
            'autocomplete' => 'off',
        ],
        'clientOptions' => [
            'forceParse' => true,
            'todayBtn' => true,
            'clearBtn' => true,
            'autoclose' => true,
            'todayHighlight' => true,
            'format' => 'dd.mm.yyyy',
        ]
    ]); ?>

<?= $form->field($model, 'date_end')->widget(
    \dosamigos\datepicker\DatePicker::className(), [
        'language' => 'ru',
        'options' => [
            'class' => 'form-control',
            'autocomplete' => 'off',
        ],
        'clientOptions' => [
            'forceParse' => true,
            'todayBtn' => true,
            'clearBtn' => true,
            'autoclose' => true,
            'todayHighlight' => true,
            'format' => 'dd.mm.yyyy',
        ]
    ]); ?>

<?= $form->field($model, 'resume_status_id')->dropDownList(ArrayHelper::map(\app\models\ResumeStatus::find()->active()->all(), 'id', 'name'), ['prompt' => '']) ?>

<?= $form->field($model, 'workplace_id')->dropDownList(ArrayHelper::map(\app\models\Workplace::find()->active()->all(), 'id', 'name'), ['prompt' => '']) ?>

<?= $form->field($model, 'rec_status_id')->radioList(
    ArrayHelper::map(\app\models\RecStatus::find()->active()->all(), 'id', 'name'), [
        'class' => 'btn-group',
        'data-toggle' => 'buttons',
        'unselect' => null, // remove hidden field
        'item' => function ($index, $label, $name, $checked, $value) {
            return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
            Html::radio($name, $checked, ['value' => $value, 'class' => 'project-status-btn']) . $label . '</label>';
        },
    ]);
?>

<?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(\app\models\User::find()->active()->all(), 'id', 'name'), ['prompt' => '']) ?>

<?= $form->field($model, 'dc')->textInput() ?>
