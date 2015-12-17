<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\ResumeProfessionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Resume Professions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resume-profession-index">

    <h1><?php //echo Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class='pull-left'>
        <?= \yii\helpers\Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'Create new'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="clearfix"></div>


    <?php \yii\widgets\Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'resume_id',
            'profession_id' => [
                'attribute'=>'profession_id',
                'value'=>'profession.name',
                'filter'=>ArrayHelper::map(\app\models\Profession::find()->active()->all(), 'id', 'name'),
            ],
            'note:ntext',
//            'rec_status_id' => [
//                'attribute'=>'rec_status_id',
//                'value'=>'recStatus.name',
//                'filter'=>ArrayHelper::map(\app\models\RecStatus::find()->active()->all(), 'id', 'name'),
//            ],
//            'user_id' => [
//                'attribute'=>'user_id',
//                'value'=>'user.name',
//                'filter'=>ArrayHelper::map(\app\models\User::find()->active()->all(), 'id', 'name'),
//            ],
            // 'dc',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions' =>['class' => 'table table-striped table-hover'],
    ]); ?>

    <?php \yii\widgets\Pjax::end(); ?>

</div>
