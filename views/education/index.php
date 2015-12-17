<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\EducationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Educations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="experience-index">

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
//            'type_id',
//            [
//                'attribute'=>'type_id',
//                'value'=>'typeName',
//                'filter'=>\app\models\Education::$list_type,
//            ],
            'person.fullName',
//            'education_type_id',
//            [
//                'attribute'=>'education_type_id',
//                'value'=>'educationTypeName',
//                'filter'=>\app\models\Education::$list_education_type,
//            ],
            'firm',
//            'profession.name',
            [
                'attribute'=>'profession_id',
                'value'=>'profession.name.name',
                'filter'=>ArrayHelper::map(\app\models\Profession::find()->active()->all(), 'id', 'name'),
            ],
            // 'city_id',
            [
                'attribute'=>'city_id',
                'value'=>'city.name.name',
                'filter'=>ArrayHelper::map(\app\models\City::find()->active()->all(), 'id', 'name'),
            ],
            // 'date_start',
            // 'date_end',
            // 'duration',
            // 'note:ntext',
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

            ['class' => 'yii\grid\ActionColumn', 'contentOptions' => ['style' => 'white-space: nowrap;']],
        ],
        'tableOptions' =>['class' => 'table table-striped table-hover'],
    ]); ?>

<?php  \yii\widgets\Pjax::end(); ?>

</div>
