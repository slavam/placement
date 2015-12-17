<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\FileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Files');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-index">

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
            'table_name',
            'class_name',
            'rec_id',
//            'type_id',
            [
                'attribute' => 'type_id',
                'value' => function ($data) {
                    return \app\models\File::$list_type[$data->type_id];
                },
                'filter' => \app\models\File::$list_type,
            ],
            'file_name',
            // 'file_path',
            // 'note:ntext',
            // 'rec_status_id',
            // 'user_id',
            // 'dc',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions' =>['class' => 'table table-striped table-hover'],
    ]); ?>

<?php  \yii\widgets\Pjax::end(); ?>

</div>
