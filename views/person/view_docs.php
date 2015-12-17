<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Person */

?>

<div style="margin: 10px;">
    <div class="btn-group">
        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Добавить
            документ<span class="caret"></span></button>
        <ul class="dropdown-menu" role="menu">
            <li>
                <a href="<?= \yii\helpers\Url::to(['/doc-inn/create', 'person_id' => $model->id]) ?>"><?= Yii::t('app', 'Inn') ?></a>
            </li>
            <li>
                <a href="<?= \yii\helpers\Url::to(['/doc-passport/create', 'person_id' => $model->id]) ?>"><?= Yii::t('app', 'Passport') ?></a>
            </li>
            <li>
                <a href="<?= \yii\helpers\Url::to(['/doc-medical/create', 'person_id' => $model->id]) ?>"><?= Yii::t('app', 'Medical') ?></a>
            </li>
            <li>
                <a href="<?= \yii\helpers\Url::to(['/doc-patent/create', 'person_id' => $model->id]) ?>"><?= Yii::t('app', 'Patent') ?></a>
            </li>
            <li>
                <a href="<?= \yii\helpers\Url::to(['/doc-exam/create', 'person_id' => $model->id]) ?>"><?= Yii::t('app', 'Exam') ?></a>
            </li>
            <li>
                <a href="<?= \yii\helpers\Url::to(['/doc-migration/create', 'person_id' => $model->id]) ?>"><?= Yii::t('app', 'Migration') ?></a>
            </li>
            <li>
                <a href="<?= \yii\helpers\Url::to(['/doc-registration/create', 'person_id' => $model->id]) ?>"><?= Yii::t('app', 'Registration') ?></a>
            </li>
        </ul>
    </div>
</div>



<?php
$dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $model->getInn()->all()]);
if ($dataProvider->totalCount) {
    ?>

    <div class="panel panel-default">
        <div class="panel-heading">ИНН</div>
        <div class="panel-body">
            <?php
            echo $this->render('/doc-inn/_list', [
                'dataProvider' => $dataProvider,
            ]);
            ?>
        </div>
    </div>
<?php } ?>


<?php
$dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $model->getPasport()->all()]);
if ($dataProvider->totalCount) {
    ?>

    <div class="panel panel-default">
        <div class="panel-heading">Паспортные данные</div>
        <div class="panel-body">
            <?php
            echo $this->render('/doc-passport/_list', [
                'dataProvider' => $dataProvider,
            ]);
            ?>
        </div>
    </div>
<?php } ?>


<?php
$dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $model->getMedical()->all()]);
if ($dataProvider->totalCount) {
    ?>

    <div class="panel panel-default">
        <div class="panel-heading">Медосмотр</div>
        <div class="panel-body">
            <?php
            echo $this->render('/doc-medical/_list', [
                'dataProvider' => $dataProvider,
            ]);
            ?>
        </div>
    </div>
<?php } ?>


<?php
$dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $model->getPatent()->all()]);
if ($dataProvider->totalCount) {
    ?>

    <div class="panel panel-default">
        <div class="panel-heading">Патенты</div>
        <div class="panel-body">
            <?php
            echo $this->render('/doc-patent/_list', [
                'dataProvider' => $dataProvider,
            ]);
            ?>
        </div>
    </div>
<?php } ?>


<?php
$dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $model->getExam()->all()]);
if ($dataProvider->totalCount) {
    ?>

    <div class="panel panel-default">
        <div class="panel-heading">Экзамены</div>
        <div class="panel-body">
            <?php
            echo $this->render('/doc-exam/_list', [
                'dataProvider' => $dataProvider,
            ]);
            ?>
        </div>
    </div>
<?php } ?>


<?php
$dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $model->getMigration()->all()]);
if ($dataProvider->totalCount) {
    ?>

    <div class="panel panel-default">
        <div class="panel-heading">Миграционные карты</div>
        <div class="panel-body">
            <?php
            echo $this->render('/doc-migration/_list', [
                'dataProvider' => $dataProvider,
            ]);
            ?>
        </div>
    </div>
<?php } ?>


<?php
$dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $model->getRegistration()->all()]);
if ($dataProvider->totalCount) {
    ?>

    <div class="panel panel-default">
        <div class="panel-heading">Регистрация</div>
        <div class="panel-body">
            <?php
            echo $this->render('/doc-registration/_list', [
                'dataProvider' => $dataProvider,
            ]);
            ?>
        </div>
    </div>
<?php } ?>

