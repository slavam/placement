<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\EducationSearch */
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
<div class="experience-index">

    <?php \yii\widgets\Pjax::begin(['id' => 'person_educations-grid', 'enablePushState' => false]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'layout' => '<div>{pager}</div><div>{items}</div>',
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//            'id',
//            'person_id',
            [
                'attribute' => 'Предприятие',
                'value' => 'firm',
            ],
            [
                'attribute' => 'Должность',
                'value' => 'profession.name',
            ],
            [
                'label' => 'Период',
                'value' => function ($data) {
                    $result = '';
                    if ($data->date_start)
                        $result .= 'с ' . Yii::$app->formatter->asDate($data->date_start) . ' ';
                    if ($data->date_end)
                        $result .= 'по ' . Yii::$app->formatter->asDate($data->date_end);
                    return $result;
                },
            ],
            [
                'attribute' => 'Описание',
                'value' => 'note',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'contentOptions' => ['class' => 'action-column'],
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::toRoute(['/experience/update', 'id' => $model->id]);
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('yii', 'Update'),
                            'data-pjax' => '#person_educations-grid',
                        ]);
                    },
                    'delete' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::toRoute(['/experience/delete', 'id' => $model->id]);
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', 'Вы уверены что хотите удалить?'),
                            'data-method' => 'post',
                            'data-pjax' => '#person_educations-grid',
                        ]);
                    },
                ],
            ],
        ],
        'tableOptions' => ['class' => 'table table-striped table-hover'],
    ]); ?>

    <?php \yii\widgets\Pjax::end(); ?>

</div>