<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Person */

?>

<div style="margin: 10px;">
    <?php echo Html::a('<span class="glyphicon glyphicon-plus"></span>', ['/file/create', 'rec_id' => $model->id], ['title' => 'Добавить новай файл', 'class' => 'btn btn-success']) ?>
</div>

<?php
$dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $model->getFiles()->all()]);
if ($dataProvider->totalCount) {
    ?>

    <?php
    echo $this->render('/file/_list', [
        'dataProvider' => $dataProvider,
    ]);
    ?>
<?php } ?>
