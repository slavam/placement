<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Resume */
/* @var $person app\models\Person */
/* @var $person_address app\models\Address */

$this->title = Yii::t('app', 'Creating');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Resumes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resume-create">

    <h1><?php //echo Html::encode($this->title) ?></h1>

    <p class='pull-left'>
        <?= \yii\helpers\Html::a('<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'List'), ['index'], ['class' => 'btn btn-default']) ?>
    </p>

    <div class="clearfix"></div>

    <?= $this->render('_form', [
        'model' => $model,
        'person' => $person,
        'person_address' => $person_address,
    ]) ?>

</div>
