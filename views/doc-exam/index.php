<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\DocExamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Exam');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doc-inn-index">

    <h1><?php //echo Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' .Yii::t('app', 'Create new'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php  \yii\widgets\Pjax::begin(); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'person_id',
//            'fullName',
            'person.fullName',
            'series',
            'num',
            'date',
            'who_give',
            // 'note:ntext',
            // 'rec_status_id',
            // 'user_id',
            // 'dc',

            ['class' => 'yii\grid\ActionColumn', 'contentOptions' => ['style' => 'white-space: nowrap;']],
        ],
        'tableOptions' =>['class' => 'table table-striped table-hover'],
    ]); ?>

<?php  \yii\widgets\Pjax::end(); ?>

</div>
