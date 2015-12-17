<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\DocPassportSearch */
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
<div class="passport-list">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '<div>{pager}</div><div>{items}</div>',
        'columns' => [
            'series',
            'num',
            'date',
            'who_give',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'contentOptions' => ['class' => 'action-column', 'style'=>'text-align: right;'],
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::toRoute(['/doc-passport/update', 'id' => $model->id]);
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('yii', 'Update'),
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::toRoute(['/doc-passport/delete', 'id' => $model->id]);
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', 'Вы уверены что хотите удалить паспорт?'),
                            'data-method' => 'post',
                        ]);
                    },
                ],
            ],
        ],
        'tableOptions' => ['class' => 'table'],
    ]); ?>

</div>