<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Resume */
/* @var $form yii\widgets\ActiveForm */
?>

<?php //echo $form->field($model, 'person_id')->textInput() ?>

<!--    --><?php /*echo $form->field($model, 'person_id')->widget(\dosamigos\selectize\SelectizeDropDownList::className(), [
        // calls an action that returns a JSON object with matched
        // tags
//        'loadUrl' => ['tag/list'],
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
    ])->hint('');
    */
?>

<?php //echo $form->field($model, 'professions')->dropDownList(ArrayHelper::map(\app\models\Profession::find()->active()->all(), 'id', 'name'), ['prompt' => '', 'multiple' => true]) ?>

<?= $form->field($model, 'professions')->widget(\dosamigos\selectize\SelectizeDropDownList::className(), [
    // calls an action that returns a JSON object with matched
    // tags
//        'loadUrl' => ['tag/list'],
    'items' => ArrayHelper::map(\app\models\Profession::find()->active()->all(), 'id', 'name'),
    'options' => [
        'multiple' => true,
        'class' => 'form-control',
    ],
    'clientOptions' => [
//            'selectOnTab' => true,
//            'openOnFocus' => false,
        'persist' => false,
        'maxItems' => null,
        'create' => false,
        'plugins' => ['remove_button'],
        'valueField' => 'id',
        'labelField' => 'name',
        'searchField' => ['name'],
    ],
])->hint('Use commas to separate tags')
?>

<?= $form->field($model, 'salary')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'resume_status_id')->dropDownList(ArrayHelper::map(\app\models\ResumeStatus::find()->active()->all(), 'id', 'name'), ['prompt' => '']) ?>

<?php $this->endBlock() ?>


<?php $this->beginBlock('other') ?>

<p></p>

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
