<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Doc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="doc-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-6\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

    <?php //echo $form->field($model, 'person_id')->textInput() ?>

    <?php echo $form->field($model, 'person_id')->widget(\dosamigos\selectize\SelectizeDropDownList::className(), [
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
    ?>

    <?= $form->field($model, 'type_id')->dropDownList(\app\models\Doc::$list_type, ['prompt' => '']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

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

    <?= $form->field($model, 'date_renewal')->widget(
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

    <?= $form->field($model, 'duration_months')->textInput() ?>

    <?= $form->field($model, 'duration_days')->textInput() ?>

    <?= $form->field($model, 'who_give')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address_id')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rec_status_id')->dropDownList(ArrayHelper::map(\app\models\RecStatus::find()->active()->all(), 'id', 'name'), ['prompt' => '']) ?>

    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(\app\models\User::find()->active()->all(), 'id', 'name'), ['prompt' => '']) ?>

    <?= $form->field($model, 'dc')->textInput() ?>

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php if ($model->hasErrors()) {
    echo \kartik\growl\Growl::widget([
        'type' => \kartik\growl\Growl::TYPE_DANGER,
        'title' => 'Необходимо исправить следующие ошибки:',
        'icon' => 'glyphicon glyphicon-exclamation-sign',
        'body' => \yii\helpers\BaseHtml::errorSummary($model, ['header' => '']),
        'showSeparator' => true,
        'delay' => 10,
        'pluginOptions' => [
            'placement' => [
                'from' => 'top',
                'align' => 'right',
            ]
        ]
    ]);
}
?>
