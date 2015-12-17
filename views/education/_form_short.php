<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Education */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="education-form">

    <?php \yii\widgets\Pjax::begin(['id' => 'person_educations-form', 'enablePushState' => false]); ?>

    <?php $form = ActiveForm::begin([
        'options' => [
            'class' => 'form-horizontal',
            'data' => [
                'pjax' => 1
            ],
        ],
//        'enableClientValidation' => true,
//        'validateOnSubmit' => false,
//        'action' => ['/education/create'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-6\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>


    <?php echo Html::activeHiddenInput($model, 'person_id') ?>

    <?php //echo $form->field($model, 'education_type_id')->textInput() ?>
    <?php echo $form->field($model, 'education_type_id')->radioList($model::$list_education_type, [
        'class' => 'btn-group',
        'data-toggle' => 'buttons',
        'unselect' => null, // remove hidden field
        'item' => function ($index, $label, $name, $checked, $value) {
            return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
            Html::radio($name, $checked, ['value' => $value, 'class' => 'project-status-btn']) . $label . '</label>';
        },
    ]);
    ?>

    <?= $form->field($model, 'firm')->widget(\dosamigos\selectize\SelectizeDropDownList::className(), [
//        'loadUrl' => ['tag/list'],
        'items' => \yii\helpers\ArrayHelper::map(\app\models\Education::find()
            ->select(['firm'])->active()->distinct()->orderBy('firm asc')->asArray()->all(), 'firm', 'firm'),
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
            'valueField' => 'firm',
            'labelField' => 'firm',
            'searchField' => ['firm'],
        ],
    ])?>

    <?php //echo $form->field($model, 'profession_id')->textInput() ?>
    <?php //echo $form->field($model, 'profession_id',['inputOptions' => ['class' => 'form-control']])->dropDownList(ArrayHelper::map(\app\models\Profession::find()->active()->all(), 'id', 'name'), ['prompt' => '']) ?>
    <?= $form->field($model, 'profession_id')->widget(\dosamigos\selectize\SelectizeDropDownList::className(), [
        // calls an action that returns a JSON object with matched
        // tags
//        'loadUrl' => ['tag/list'],
        'items' => ArrayHelper::map(\app\models\Profession::find()->active()->all(), 'id', 'name'),
        'options' => [
            'multiple' => false,
            'class' => 'form-control',
            'prompt' => '',
        ],
        'clientOptions' => [
//            'selectOnTab' => true,
            'openOnFocus' => false,
            'persist' => false,
            'maxItems' => 1,
            'create' => false,
//            'plugins' => ['remove_button'],
            'valueField' => 'id',
            'labelField' => 'name',
            'searchField' => ['name'],
        ],
    ])?>

    <?php //echo= $form->field($model, 'city_id')->textInput() ?>

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

    <?php //echo $form->field($model, 'duration')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php if($model->hasErrors()){
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

<?php \yii\widgets\Pjax::end(); ?>
