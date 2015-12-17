<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\File */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal', 'enctype'=>'multipart/form-data'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-6\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

    <?php //echo $form->field($model, 'rec_id')->textInput() ?>

    <?php echo Html::activeHiddenInput($model, 'rec_id') ?>

    <?php //echo  $form->field($model, 'table_name')->textInput(['maxlength' => true]) ?>

    <?php //echo  $form->field($model, 'class_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_id')->dropDownList(\app\models\File::$list_type, ['prompt' => '']) ?>

    <?php //echo  $form->field($model, 'file_name')->textInput(['maxlength' => true]) ?>

    <?php //echo  $form->field($model, 'file_path')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'files[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
<!--    --><?php //echo $form->field($model, 'files')->fileInput(['multiple' => true]) ?>

<!--    --><?php /*echo \dosamigos\fileupload\FileUploadUI::widget([
        'model' => $model,
        'attribute' => 'files',
        'url' => Yii::$app->request->getUrl(),
//        'url' => ['media/upload', 'id' => $tour_id],
        'gallery' => false,
        'fieldOptions' => [
            'accept' => 'image/*'
        ],
        'clientOptions' => [
            'maxFileSize' => 2000000
        ],
        // ...
        'clientEvents' => [
            'fileuploaddone' => 'function(e, data) {
                                    console.log(e);
                                    console.log(data);
                                }',
            'fileuploadfail' => 'function(e, data) {
                                    console.log(e);
                                    console.log(data);
                                }',
        ],
    ]);
    */?>

    <?php //echo  $form->field($model, 'rec_status_id')->dropDownList(ArrayHelper::map(\app\models\RecStatus::find()->active()->all(), 'id', 'name'), ['prompt' => '']) ?>

    <?php //echo  $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(\app\models\User::find()->active()->all(), 'id', 'name'), ['prompt' => '']) ?>

    <?php //echo  $form->field($model, 'dc')->textInput() ?>

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
