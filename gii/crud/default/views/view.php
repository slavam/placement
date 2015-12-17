<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = $model-><?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view">

    <h1><?= "<?php //echo " ?>Html::encode($this->title) ?></h1>

    <p>
        <?= "<?= " ?>Html::a('<span class="glyphicon glyphicon-list"></span> ' .<?= $generator->generateString('List') ?>, ['index'], ['class' => 'btn btn-default']) ?>
        <?= "<?= " ?>Html::a('<span class="glyphicon glyphicon-plus"></span> ' .<?= $generator->generateString('Create new') ?>, ['create'], ['class' => 'btn btn-success']) ?>
        <?= "<?= " ?>Html::a('<span class="glyphicon glyphicon-pencil"></span> ' .<?= $generator->generateString('Update') ?>, ['update', <?= $urlParams ?>], ['class' => 'btn btn-primary']) ?>
        <?= "<?= " ?>Html::a('<span class="glyphicon glyphicon-trash"></span> ' .<?= $generator->generateString('Delete') ?>, ['delete', <?= $urlParams ?>], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => <?= $generator->generateString('Вы уверены что хотите удалить эту запись?') ?>,
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= "<?= " ?>DetailView::widget([
        'model' => $model,
        'attributes' => [
<?php
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        echo "            '" . $name . "',\n";
    }
} else {
    foreach ($generator->getTableSchema()->columns as $column) {
        if ($column->name == 'user_id'){
            echo "            'user.name" . "',\n";
        }elseif ($column->name == 'rec_status_id'){
                echo "            'recStatus.name" . "',\n";
        }else{
            $format = $generator->generateColumnFormat($column);
            echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        }
    }
}
?>
        ],
    ]) ?>

</div>
