<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\File */

$this->title = Yii::t('app', 'Creating');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Files'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-create">

    <h1><?php //echo Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> ' .Yii::t('app', 'List'), ['index'], ['class' => 'btn btn-default']) ?>
    </p>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
