<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\FileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<?php
//$this->registerJs(
//    '$("document").ready(function(){
//            $("#person_educations-form").on("pjax:end", function() {
//            $.pjax.reload({container:"#person_educations-grid"});  //Reload GridView
//        });
//    });'
//);
?>
<div class="file-list">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '<div>{pager}</div><div>{items}</div>',
        'columns' => [
//            'id',
//            'table_name',
//            'class_name',
//            'rec_id',
            [
                'attribute' => 'type_id',
                'value' => function ($data) {
                    return \app\models\File::$list_type[$data->type_id];
                },
                'filter' => \app\models\File::$list_type,
            ],
            [
                'attribute' => 'files',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img(\yii\helpers\Url::base(). '/../uf/' . $data['file_name'],
                        ['width' => '300px']);
                },
            ],
//            'file_name',
//             'file_path',
             'note:ntext',
            // 'rec_status_id',
            // 'user_id',
            // 'dc',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'contentOptions' => ['class' => 'action-column', 'style'=>'text-align: right;'],
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::toRoute(['/file/update', 'id' => $model->id]);
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('yii', 'Update'),
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::toRoute(['/file/delete', 'id' => $model->id]);
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', 'Вы уверены что хотите удалить файл?'),
                            'data-method' => 'post',
                        ]);
                    },
                ],
            ],
        ],
        'tableOptions' => ['class' => 'table'],
    ]); ?>

</div>