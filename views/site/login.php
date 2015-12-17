<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Вход в систему';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-offset-4 col-lg-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?= $this->title ?></h3>
        </div>
        <div class="site-login highlight" style="padding: 20px;">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
//            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-5\">{error}</div>",
//            'labelOptions' => ['class' => 'col-lg-3 control-label'],
                    'template' => "<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                ],
            ]); ?>

            <?= $form->field($model, 'username', ['inputOptions' => ['placeholder'=>$model->getAttributeLabel('username'),'autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '0']]) ?>

            <?= $form->field($model, 'password', ['inputOptions' => ['placeholder'=>$model->getAttributeLabel('password'), 'class' => 'form-control']])->passwordInput() ?>

            <div class="form-group">
                <div class="col-lg-4">
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
