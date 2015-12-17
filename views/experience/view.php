<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Experience */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Experiences'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="experience-view">

    <h1><?php //echo Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'List'), ['index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'Create new'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Вы уверены что хотите удалить эту запись?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'typeName',
            [
                'label' => $model->getAttributeLabel('person_id'),
                'value' => $model->person ? $model->person->fullName : null,
            ],
//            'educationTypeName',
            'firm',
            'profession.name',
            'city.name',
            'date_start:date',
            'date_end:date',
            'duration',
            'note:ntext',
            'recStatus.name',
            'user.name',
            'dc',
        ],
    ]) ?>

</div>
