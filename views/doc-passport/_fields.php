<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DocPassport */
/* @var $form yii\widgets\ActiveForm */
?>

<?php echo Html::activeHiddenInput($model, 'person_id') ?>

<?php /*echo $form->field($model, 'person_id')->widget(\dosamigos\selectize\SelectizeDropDownList::className(), [
    'items' => ArrayHelper::map(\app\models\Person::find()->active()->all(), 'id', 'fullName'),
    'options' => [
        'multiple' => false,
        'class' => 'form-control',
        'prompt' => '',
    ],
    'clientOptions' => [
        'selectOnTab' => true,
        'openOnFocus' => false,
        'persist' => false,
        'maxItems' => 1,
        'create' => false,
//            'plugins' => ['remove_button'],
        'valueField' => 'id',
        'labelField' => 'fullName',
        'searchField' => ['fullName'],
    ],
]);*/
?>

<?= $form->field($model, 'series')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'num')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'date')->widget(
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


<?= $form->field($model, 'who_give')->widget(\dosamigos\selectize\SelectizeDropDownList::className(), [
    'items' => \yii\helpers\ArrayHelper::map(\app\models\DocPassport::find()
        ->select(['who_give'])->active()->distinct()->orderBy('who_give asc')->asArray()->all(), 'who_give', 'who_give'),
    'options' => [
        'multiple' => false,
        'class' => 'form-control',
        'prompt' => '',
    ],
    'clientOptions' => [
        'selectOnTab' => true,
        'openOnFocus' => false,
        'persist' => false,
        'maxItems' => 1,
        'create' => true,
//        'plugins' => ['remove_button'],
        'valueField' => 'who_give',
        'labelField' => 'who_give',
        'searchField' => ['who_give'],
    ],])?>

<?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>
