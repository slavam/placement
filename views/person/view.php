<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Person */

$this->title = $model->getFullName();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'People'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="person-view">

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


        <?php $this->beginBlock('person') ?>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'fullName',
                'id',
                'lname',
                'fname',
                'mname',
                'birthday',
                'sexName',
//            'sex',
                'address.fullName',
//            'address_id',
                'email:email',
                'phone',
                'note:ntext',
                'recStatus.name',
                'user.name',
                'dc',
            ],
        ]) ?>

        <?php $this->endBlock() ?>


        <?php $this->beginBlock('experiences') ?>
        <div style="margin: 10px;">
            <?= Html::a('<span class="glyphicon glyphicon-plus"></span>', ['/experience/create', 'person_id' => $model->id], ['title' => 'Добавить новое место работы', 'class' => 'btn btn-success']) ?>
        </div>
        <?php
        //    foreach ($model->experiences as $exp) {
        //        echo $this->render('/experience/_item_view', [
        //            'model' => $exp,
        //        ]);
        //    }

        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $model->experiences]);
        echo $this->render('/experience/_list', [
            'dataProvider' => $dataProvider,
        ]);
        ?>
        <?php $this->endBlock() ?>


        <?php $this->beginBlock('educations') ?>
        <div style="margin: 10px;">
            <?php echo Html::a('<span class="glyphicon glyphicon-plus"></span>', ['/education/create', 'person_id' => $model->id], ['title' => 'Добавить новое образование', 'class' => 'btn btn-success']) ?>
        </div>
        <?php
        //        foreach ($model->educations as $edu) {
        //            echo $this->render('/education/_item_view', [
        //                'model' => $edu,
        //            ]);
        //        }
        ?>
        <?php
        $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $model->educations]);
        echo $this->render('/education/_list', [
            'dataProvider' => $dataProvider,
        ]);

        ?>
        <?php $this->endBlock() ?>


        <?php if (false) { ?>
            <?php $this->beginBlock('docs') ?>
            <div style="margin: 10px;">
                <div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Добавить
                        документ
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu" role="menu">
                        <?php
                        foreach (\app\models\Doc::$list_type as $doc_id => $doc) {
                            ?>
                            <li>
                                <a href="<?= \yii\helpers\Url::to(['/doc/create', 'person_id' => $model->id, 'type_id' => $doc_id]) ?>"><?= $doc ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <?php
            $dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $model->getDocs()->all()]);
            echo $this->render('/doc/_list', [
                'dataProvider' => $dataProvider,
            ]);
            ?>
            <?php $this->endBlock() ?>
        <?php } ?>



        <?php $this->beginBlock('docs') ?>

        <?= $this->render('/person/view_docs', [
            'model' => $model,
        ]) ?>

        <?php $this->endBlock() ?>



        <?php $this->beginBlock('files') ?>

        <?= $this->render('/person/view_files', [
            'model' => $model,
        ]) ?>

        <?php $this->endBlock() ?>


        <?= \yii\bootstrap\Tabs::widget([
            'items' => [
                [
                    'label' => 'Личные данные',
                    'content' => $this->blocks['person'],
//                'active' => true,
//            'options' => ['id' => 'tab_person'],
                ],
                [
                    'label' => 'Опыт работы ' . '<span title="Количество мест работы" style="margin-left: 10px;" class="label label-primary pull-right" > ' . count($model->experiences) . '</span>',
                    'encode' => false,
                    'content' => $this->blocks['experiences'],
//                'active' => false,
//            'options' => ['id' => 'tab_exp'],
                ],
                [
                    'label' => 'Образование ' . '<span title="Количество образований" style="margin-left: 10px;" class="label label-primary pull-right" > ' . count($model->educations) . '</span>',
                    'encode' => false,
                    'content' => $this->blocks['educations'],
//                'active' => false,
//            'options' => ['id' => 'tab_edu'],
                ],
                [
                    'label' => 'Документы ' . '<span title="Количество образований" style="margin-left: 10px;" class="label label-primary pull-right" > ' . $model->getDocsCount() . '</span>',
                    'encode' => false,
                    'content' => $this->blocks['docs'],
                ],
                [
                    'label' => 'Файлы ' . '<span title="Количество файлов" style="margin-left: 10px;" class="label label-primary pull-right" > ' . count($model->files) . '</span>',
                    'encode' => false,
                    'content' => $this->blocks['files'],
                ],
            ],
        ]) ?>

    </div>


<?php
//echo \yii\helpers\VarDumper::dumpAsString(($model->getDocs()->all()), 2, true);
?>