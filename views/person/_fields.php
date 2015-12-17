<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $address app\models\Address */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-default">
    <div class="panel-heading" style="margin-bottom: 20px;">
        <h3 class="panel-title"><?= 'Личные данные' ?></h3>
    </div>
    <div class="panel-body" style="padding: 10px;">

        <?= $form->field($model, 'lname')->widget(\dosamigos\selectize\SelectizeDropDownList::className(), [
//        'loadUrl' => ['tag/list'],
            'items' => \yii\helpers\ArrayHelper::map(\app\models\Person::find()
                ->select(['lname'])->active()->distinct()->orderBy('lname asc')->asArray()->all(), 'lname', 'lname'),
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
                'valueField' => 'lname',
                'labelField' => 'lname',
                'searchField' => ['lname'],
            ],
        ])->hint('')
        ?>

<!--        --><?php /*echo $form->field($model, 'fname')->widget(\yii\jui\AutoComplete::classname(), [
            'options' => [
                'class' => 'form-control'
            ],
            'clientOptions' => [
                'source' => \app\models\Person::find()
                    ->select(['fname as value'])->active()->distinct()->orderBy('fname asc')->asArray()->all(),
                'autoFocus' => true,
                'minLength' => '1',
                'delay' => '100',
            ],
        ]); */?>

        <?= $form->field($model, 'fname')->widget(\dosamigos\selectize\SelectizeDropDownList::className(), [
//        'loadUrl' => ['tag/list'],
            'items' => \yii\helpers\ArrayHelper::map(\app\models\Person::find()
                ->select(['fname'])->active()->distinct()->orderBy('fname asc')->asArray()->all(), 'fname', 'fname'),
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
                'valueField' => 'fname',
                'labelField' => 'fname',
                'searchField' => ['fname'],
            ],
        ])->hint('')
        ?>

        <?= $form->field($model, 'mname')->widget(\dosamigos\selectize\SelectizeDropDownList::className(), [
//        'loadUrl' => ['tag/list'],
            'items' => \yii\helpers\ArrayHelper::map(\app\models\Person::find()
                ->select(['mname'])->active()->distinct()->orderBy('mname asc')->asArray()->all(), 'mname', 'mname'),
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
                'valueField' => 'mname',
                'labelField' => 'mname',
                'searchField' => ['mname'],
            ],
        ])->hint('')
        ?>

        <?php //echo $form->field($model, 'birthday')->textInput() ?>

        <?= $form->field($model, 'birthday')->widget(
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

        <?= $form->field($model, 'sex')->radioList($model::$list_sex, [
                'class' => 'btn-group',
                'data-toggle' => 'buttons',
                'unselect' => null, // remove hidden field
                'item' => function ($index, $label, $name, $checked, $value) {
                    return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
                    Html::radio($name, $checked, ['value' => $value, 'class' => 'project-status-btn']) . $label . '</label>';
                },
            ]);
        ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>
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
