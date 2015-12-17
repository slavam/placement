<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Workplace */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="workplace-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-6\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

    <div class="panel panel-default">
        <div class="panel-heading" style="margin-bottom: 20px;">
            <h3 class="panel-title"><?= 'Основные данные' ?></h3>
        </div>
        <div style="padding: 10px;">
            <?= $form->field($model, 'name', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control']])->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading" style="margin-bottom: 20px;">
            <h3 class="panel-title"><?= $model->getAttributeLabel('address_id') ?></h3>
        </div>
        <div style="padding: 10px;">
            <?php //echo $form->field($model, 'address_id')->textInput() ?>
            <?= $this->render('/address/_fields', [
                'model' => $model->address ? $model->address : new \app\models\Address(),
                'form' => $form,
            ]) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading" style="margin-bottom: 20px;">
            <h3 class="panel-title"><?= 'Прочее' ?></h3>
        </div>
        <div style="padding: 10px;">
            <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'rec_status_id')->radioList(
                ArrayHelper::map(\app\models\RecStatus::find()->active()->all(), 'id', 'name'),[
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
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
if($model->hasErrors()){
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
