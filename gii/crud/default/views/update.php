<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = <?= $generator->generateString('Updating') ?> . ' ' . $model-><?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model-><?= $generator->getNameAttribute() ?>, 'url' => ['view', <?= $urlParams ?>]];
$this->params['breadcrumbs'][] = <?= $generator->generateString('Updating') ?>;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-update">

    <h1><?= "<?php //echo " ?>Html::encode($this->title) ?></h1>

    <p>
        <?= "<?= " ?>Html::a('<span class="glyphicon glyphicon-list"></span> ' .<?= $generator->generateString('List') ?>, ['index'], ['class' => 'btn btn-default']) ?>
        <?= "<?= " ?>Html::a('<span class="glyphicon glyphicon-plus"></span> ' .<?= $generator->generateString('Create new') ?>, ['create'], ['class' => 'btn btn-success']) ?>
        <?= "<?= " ?>Html::a('<span class="glyphicon glyphicon-trash"></span> ' .<?= $generator->generateString('Delete') ?>, ['delete', <?= $urlParams ?>], [
        'class' => 'btn btn-danger',
        'data' => [
        'confirm' => <?= $generator->generateString('Вы уверены что хотите удалить эту запись?') ?>,
        'method' => 'post',
        ],
        ]) ?>
    </p>

    <?= "<?= " ?>$this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
