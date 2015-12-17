<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Resume */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$active_tab = 0;
$model_errors = '';
$person_errors = '';
$other_errors = '';

//echo print_r($model->errors);

if ($model->hasErrors()) {
    echo \kartik\growl\Growl::widget([
        'type' => \kartik\growl\Growl::TYPE_DANGER,
        'title' => 'Ошибки в резюме:',
        'icon' => 'glyphicon glyphicon-exclamation-sign',
        'body' => \yii\helpers\BaseHtml::errorSummary($model, ['header' => '']),
        'showSeparator' => true,
        'delay' => 100,
        'pluginOptions' => [
            'placement' => [
                'from' => 'top',
                'align' => 'right',
            ]
        ]
    ]);
    $main_err = $model->hasErrors('salary') + 0;
    $model_errors = $main_err ? ' <span title="Количество ошибок" style="margin-left: 10px;" class="label label-danger pull-right" > ' . $main_err . '</span>' : '';
    $other_errors = (count($model->errors) > $main_err) ? ' <span title="Количество ошибок" style="margin-left: 10px;" class="label label-danger pull-right" > ' . (count($model->errors) - $main_err) . '</span>' : '';
    if ($active_tab == 0 && $main_err > 0) $active_tab = 1;
    if ($active_tab == 0 && (count($model->errors) > $main_err)) $active_tab = 2;
}

if ($person->hasErrors() || $person_address->hasErrors()) {
    echo \kartik\growl\Growl::widget([
        'type' => \kartik\growl\Growl::TYPE_DANGER,
        'title' => 'Ошибки в личных данных соискателя:',
        'icon' => 'glyphicon glyphicon-exclamation-sign',
        'body' => (\yii\helpers\BaseHtml::errorSummary($person, ['header' => '']) . \yii\helpers\BaseHtml::errorSummary($person_address, ['header' => ''])),
        'showSeparator' => true,
        'delay' => 1100,
        'pluginOptions' => [
            'placement' => [
                'from' => 'top',
                'align' => 'right',
            ]
        ]
    ]);
    $person_errors = (count($person->errors) || count($person_address->errors)) ? ' <span title="Количество ошибок" style="margin-left: 10px;" class="label label-danger pull-right" > ' . (count($person->errors) + count($person_address->errors)) . '</span>' : '';
    if ($active_tab != 1) $active_tab = 3;
}
?>

<div class="resume-form">

<?php $form = ActiveForm::begin([
    'enableClientValidation' => true,
    'validateOnSubmit' => false,
//        'enableAjaxValidation' => true,
//        'validationUrl'=>['av'],
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-6\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-2 control-label'],
    ],
]); ?>

<?php $this->beginBlock('main') ?>
<p></p>
<?= $this->render('_fields_main', [
    'form' => $form,
    'model' => $model,
    'person' => $person,
    'person_address' => $person_address,
]) ?>
<?php $this->endBlock() ?>


<?php $this->beginBlock('other') ?>
<p></p>
<?= $this->render('_fields_other', [
    'form' => $form,
    'model' => $model,
    'person' => $person,
    'person_address' => $person_address,
]) ?>
<?php $this->endBlock() ?>


<?php $this->beginBlock('person') ?>
<p></p>
<?php
echo $this->render('/person/_fields', [
    'model' => $person,
    'address' => $person_address,
    'form' => $form,
]);
?>
<?php $this->endBlock() ?>

<!--
<?php /*$this->beginBlock('experiences') */?>
<div style="margin: 10px;">
    <?/*= Html::a('<span class="glyphicon glyphicon-plus"></span>', ['/experience/create', 'person_id' => $model->person_id], ['title' => 'Добавить новое место работы', 'class' => 'btn btn-success']) */?>
</div>
<?php
/*if ($model->person) {
    foreach ($model->person->experiences as $exp) {
        echo $this->render('/experience/_item_view', [
            'model' => $exp,
        ]);
    }
}
*/?>
<?php /*$this->endBlock() */?>


<?php /*$this->beginBlock('educations') */?>
<div style="margin: 10px;">
    <?/*= Html::a('<span class="glyphicon glyphicon-plus"></span>', ['/education/create', 'person_id' => $model->person_id], ['title' => 'Добавить новое образование', 'class' => 'btn btn-success']) */?>
</div>
    <?php
/*    if($model->person){
        foreach ($model->person->educations as $edu) {
            echo $this->render('/education/_item_view', [
                'model' => $edu,
            ]);
        }
    }

*/?>
<?php /*$this->endBlock() */?>

-->
<?php
echo \yii\bootstrap\Tabs::widget([
    'items' => [
        [
            'label' => 'Резюме' . $model_errors,
            'encode' => false,
            'content' => $this->blocks['main'],
            'active' => $active_tab < 2,
        ],
        [
            'label' => 'Личные данные соискателя ' . $person_errors,
            'encode' => false,
            'content' => $this->blocks['person'],
            'active' => $active_tab == 3,
        ],
        [
            'label' => 'Прочее ' . $other_errors,
            'encode' => false,
            'content' => $this->blocks['other'],
            'active' => $active_tab == 2,
        ],
/*        [
            'label' => 'Опыт работы ' . '<span title="Количество мест работы" style="margin-left: 10px;" class="label label-primary pull-right" > ' . count($model->person->experiences) . '</span>',
            'encode' => false,
            'content' => $this->blocks['experiences'],
            'active' => $active_tab == 5,
            'options' => ['id' => 'tab_exp'],
        ],
        [
            'label' => 'Образование ' . '<span title="Количество образований" style="margin-left: 10px;" class="label label-primary pull-right" > ' . count($model->person->educations) . '</span>',
            'encode' => false,
            'content' => $this->blocks['educations'],
            'active' => $active_tab == 4,
            'options' => ['id' => 'tab_edu'],
        ],*/
    ],
])

?>

<hr>
<div class="form-group">
    <div class="col-lg-offset-0 col-lg-10">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Добавить резюме') : Yii::t('app', 'Сохранить изменения'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>


<?php ActiveForm::end(); ?>

</div>
