<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
// use yii\widgets\ListView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\VacancySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Vacancies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacancy-index">

    <p class='pull-left'>
        <?= \Yii::$app->user->can('/vacancy/create')? \yii\helpers\Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'Create new'), ['create'], ['class' => 'btn btn-success']) : ''       ?>
    </p>

    <div class="clearfix"></div>

    <?php \yii\widgets\Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'person_id' => [
            //     'attribute'=>'person_id',
            //     'value'=>'person.fullname',
            //     'filter'=>ArrayHelper::map(\app\models\Person::find()->active()->all(), 'id', 'lname'),
            // ],
            // 'professionNames' => [
            //     'attribute'=>'resumeProfessions',
            //     'value'=>'professionNames',
            //     'filter'=>ArrayHelper::map(\app\models\Profession::find()->active()->all(), 'id', 'name'),
            // ],
            'firm_id' => [
                'attribute'=>'firm_id',
                'value'=>'firm.name',
                'filter'=>ArrayHelper::map(\app\models\Firm::find()->active()->orderBy('name')->all(), 'id', 'name'),
            ],
            'profession_id' => [
                'attribute'=>'profession_id',
                'value'=>'profession.name',
                'filter'=>ArrayHelper::map(\app\models\Profession::find()->active()->orderBy('name')->all(), 'id', 'name'),
            ],
            'date',
            'salary',

            ['class' => 'yii\grid\ActionColumn', 'contentOptions' => ['style' => 'white-space: nowrap;']],
        ],
        'tableOptions' =>['class' => 'table table-striped table-hover'],
    ]); ?>

    <?php \yii\widgets\Pjax::end(); ?>

</div>
