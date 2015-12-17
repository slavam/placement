<?php
/* @var $this yii\web\View */
/* @var $model app\models\Address */
/* @var $form yii\widgets\ActiveForm */
?>

<?php // echo  $form->field($model, 'region_id', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control']])->textInput() ?>

<?php //echo $form->field($model, 'region_name')->widget(\yii\jui\AutoComplete::classname(), [
//    'options' => [
//        'value' => $model->region_id ? $model->region->name : null,
//        'class' => 'form-control',
////        'autofocus' => 'autofocus',
//    ],
//    'clientOptions' => [
//        'source' => \app\models\Region::find()
//            ->select(['name as value', 'id'])
//            ->active()
//            ->asArray()
//            ->all(),
//        'autoFocus' => true,
//        'minLength' => '1',
//        'delay' => '100',
////            'change' => new \yii\web\JsExpression("function( event, ui ) {
////                if(!ui.item) $('#address-region_id').val('');
////            }"),
////            'select' => new \yii\web\JsExpression("function( event, ui ) {
////                $('#address-region_id').val(ui.item.id);
////            }"),
//    ],
//]);
?>

<?= $form->field($model, 'region_name')->widget(\dosamigos\selectize\SelectizeDropDownList::className(), [
    'items' => \yii\helpers\ArrayHelper::map(\app\models\Region::find()
        ->select(['name'])
        ->active()
        ->orderBy('name asc')
        ->asArray()
        ->all(), 'name', 'name'),
    'options' => [
        'multiple' => false,
        'class' => 'form-control',
        'prompt' => '',
    ],
    'clientOptions' => [
        'allowEmptyOption' => true,
        'selectOnTab' => true,
        'openOnFocus' => false,
        'persist' => false,
        'maxItems' => 1,
        'create' => true,
//        'plugins' => ['restore_on_backspace'],
        'valueField' => 'name',
        'labelField' => 'name',
        'searchField' => ['name'],
    ],
])->hint('')
?>

<?php // echo $form->field($model, 'city_id')->textInput() ?>

<?= $form->field($model, 'city_name')->widget(\dosamigos\selectize\SelectizeDropDownList::className(), [
    'items' => \yii\helpers\ArrayHelper::map(\app\models\City::find()
        ->select(['name'])
        ->active()
        ->orderBy('name asc')
        ->asArray()
        ->all(), 'name', 'name'),
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
        'valueField' => 'name',
        'labelField' => 'name',
        'searchField' => ['name'],
    ],
])->hint('')
?>

<?php /*echo $form->field($model, 'city_name')->widget(\kartik\select2\Select2::classname(), [
        'data' => \app\models\City::find()
            ->select(['name'])
            ->active()
            ->asArray()
            ->all(),
        'theme' => \kartik\select2\Select2::THEME_BOOTSTRAP,
        'options' => ['placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);*/
?>

<?= $form->field($model, 'street')->widget(\dosamigos\selectize\SelectizeDropDownList::className(), [
//        'loadUrl' => ['tag/list'],
    'items' => \yii\helpers\ArrayHelper::map(\app\models\Address::find()
        ->select(['street'])
        ->active()
        ->distinct()
        ->orderBy('street asc')
        ->asArray()
        ->all(), 'street', 'street'),
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
        'valueField' => 'street',
        'labelField' => 'street',
        'searchField' => ['street'],
    ],
])->hint('')
?>

<?php //echo $form->field($model, 'street')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'house')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'room')->textInput(['maxlength' => true]) ?>