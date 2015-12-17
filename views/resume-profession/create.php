<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ResumeProfession */

$this->title = Yii::t('app', 'Creating');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Resume Professions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resume-profession-create">

    <h1><?php //echo Html::encode($this->title) ?></h1>

    <p class='pull-left'>
        <?= \yii\helpers\Html::a('<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'List'), ['index'], ['class' => 'btn btn-default']) ?>
    </p>

    <div class="clearfix"></div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
