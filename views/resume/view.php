<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Resume */

$this->title = 'Резюме #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Resumes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resume-view">

    <h1><?php //echo Html::encode($this->title) ?></h1>

    <p class='pull-left'>
        <?= \yii\helpers\Html::a('<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'List'), ['index'], ['class' => 'btn btn-default']) ?>
        <?= \yii\helpers\Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'Create new'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= \yii\helpers\Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= \yii\helpers\Html::a('<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Вы уверены что хотите удалить эту запись?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="clearfix"></div>

    <?php $this->beginBlock('main') ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
//            'person_id',
            'person.fullName',
            'professionNames',
            'salary',
            'vacancy_id',
            'date_start:date',
            'date_end:date',
            'note:ntext',
            'resumeStatus.name',
            'workplace.name',
            'recStatus.name',
            'user.name',
            'dc:datetime',
        ],
    ]) ?>
    <?php $this->endBlock() ?>


    <?php $this->beginBlock('person') ?>
    <?= DetailView::widget([
        'model' => $model->person,
        'attributes' => [
//            'id',
            'fullName',
//            'lname',
//            'fname',
//            'mname',
            'birthday',
            'sexName',
            'address.fullName',
            'email:email',
            'phone',
            'note:ntext',
//            'recStatus.name',
//            'user.name',
//            'dc',
        ],
    ]) ?>
    <?php $this->endBlock() ?>


    <?php $this->beginBlock('experiences') ?>
    <div style="margin: 10px;">
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span>', ['/experience/create', 'person_id' => $model->person_id], ['title' => 'Добавить новое место работы', 'class' => 'btn btn-success']) ?>
    </div>
    <?php
    if($model->person) {
//        foreach ($model->person->experiences as $exp) {
//            echo $this->render('/experience/_item_view', [
//                'model' => $exp,
//            ]);
//        }
        $dataProvider =new \yii\data\ArrayDataProvider(['allModels' => $model->person->experiences]);
        echo $this->render('/experience/_list', [
            'dataProvider' => $dataProvider,
        ]);
    }
    ?>
    <?php $this->endBlock() ?>


    <?php $this->beginBlock('educations') ?>
    <div style="margin: 10px;">
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span>', ['/education/create', 'person_id' => $model->person_id], ['title' => 'Добавить новое образование', 'class' => 'btn btn-success']) ?>
    </div>
    <?php
    if($model->person){
//        foreach ($model->person->educations as $edu) {
//            echo $this->render('/education/_item_view', [
//                'model' => $edu,
//            ]);
//        }
        $dataProvider =new \yii\data\ArrayDataProvider(['allModels' => $model->person->educations]);
        echo $this->render('/education/_list', [
            'dataProvider' => $dataProvider,
        ]);
    }
    ?>
    <?php $this->endBlock() ?>


    <?php $this->beginBlock('docs') ?>

    <?= $this->render('/person/view_docs', [
        'model' => $model->person,
    ]) ?>

    <?php $this->endBlock() ?>



    <?php $this->beginBlock('files') ?>

    <?= $this->render('/person/view_files', [
        'model' => $model->person,
    ]) ?>

    <?php $this->endBlock() ?>


    <?= \yii\bootstrap\Tabs::widget([
        'items' => [
            [
                'label' => 'Резюме',
                'content' => $this->blocks['main'],
                'active' => $at == "tab_main" || $at == null,
                'options' => ['id' => 'tab_main'],
            ],
            [
                'label' => 'Личные данные соискателя ',
                'content' => $this->blocks['person'],
                'active' => $at == "tab_person",
                'options' => ['id' => 'tab_person'],
            ],
            [
                'label' => 'Опыт работы ' . '<span title="Количество мест работы" style="margin-left: 10px;" class="label label-primary pull-right" > ' . count($model->person->experiences) . '</span>',
                'encode' => false,
                'content' => $this->blocks['experiences'],
                'active' => $at == "tab_exp",
                'options' => ['id' => 'tab_exp'],
            ],
            [
                'label' => 'Образование ' . '<span title="Количество образований" style="margin-left: 10px;" class="label label-primary pull-right" > ' . count($model->person->educations) . '</span>',
                'encode' => false,
                'content' => $this->blocks['educations'],
                'active' => $at == "tab_edu",
                'options' => ['id' => 'tab_edu'],
            ],
            [
                'label' => 'Документы ' . '<span title="Количество образований" style="margin-left: 10px;" class="label label-primary pull-right" > ' . $model->person->getDocsCount() . '</span>',
                'encode' => false,
                'content' => $this->blocks['docs'],
                'active' => $at == "tab_docs",
                'options' => ['id' => 'tab_docs'],
            ],
            [
                'label' => 'Файлы ' . '<span title="Количество образований" style="margin-left: 10px;" class="label label-primary pull-right" > ' . count($model->person->files). '</span>',
                'encode' => false,
                'content' => $this->blocks['files'],
                'active' => $at == "tab_files",
                'options' => ['id' => 'tab_files'],
            ],
        ],
    ]) ?>

</div>
