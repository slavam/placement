<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Firm */
/* @var $address app\models\Address */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
//echo '<br>\yii\helpers\Url::previous()::'.\yii\helpers\Url::previous();
//echo '<br>Yii::$app->request->referrer::'.Yii::$app->request->referrer;
//echo '<br>Yii::$app->homeUrl::'.Yii::$app->homeUrl;
//echo '<br>Url::current()::'.\yii\helpers\Url::current();
//echo '<br>Yii::app()->request->url::'.Yii::$app->request->absoluteUrl;
//echo '<br>Yii::$app->request->hostInfo::'.Yii::$app->request->hostInfo;
//?>

<div class="firm-form">

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
        <div class="panel-body" style="padding: 10px;">
            <?= $form->field($model, 'name', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control']])->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'okpo')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'director')->textInput(['maxlength' => true]) ?>
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
                'model' => $address,
                'form' => $form,
            ]) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading" style="margin-bottom: 20px;">
            <h3 class="panel-title"><?= 'Банковские реквизиты' ?></h3>
        </div>
        <div style="padding: 10px;">
            <?php //echo $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'bank_name')->widget(\yii\jui\AutoComplete::classname(), [
                'options' => [
                    'class' => 'form-control'
                ],
                'clientOptions' => [
                    'source' => \app\models\Firm::find()
                        ->select(['bank_name as value'])
                        ->active()
                        ->distinct()
                        ->orderBy('bank_name asc')
                        ->asArray()
                        ->all(),
                    'autoFocus' => true,
                    'minLength' => '1',
                    'delay' => '100',
                ],
            ]); ?>
            <?= $form->field($model, 'bank_mfo')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'bank_rs')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading" style="margin-bottom: 20px;">
            <h3 class="panel-title"><?= 'Свидетельство о регистрации' ?></h3>
        </div>
        <div style="padding: 10px;">
            <?= $form->field($model, 'svid_num')->textInput(['maxlength' => true]) ?>
            <?php //echo $form->field($model, 'svid_date')->textInput() ?>
            <?= $form->field($model, 'svid_date')->widget(
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
                ]);?>
            <?php //echo $form->field($model, 'svid_who_give')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'svid_who_give')->widget(\yii\jui\AutoComplete::classname(), [
                'options' => [
                    'class' => 'form-control'
                ],
                'clientOptions' => [
                    'source' => \app\models\Firm::find()
                        ->select(['svid_who_give as value'])
                        ->active()
                        ->distinct()
                        ->orderBy('svid_who_give asc')
                        ->asArray()
                        ->all(),
                    'autoFocus' => true,
                    'minLength' => '1',
                    'delay' => '100',
                ],
            ]); ?>
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
