<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <!--    --><?php
    //    yii\bootstrap\Modal::begin([
    //        'headerOptions' => ['id' => 'modalHeader'],
    //        'id' => 'modal',
    //        'size' => 'modal-lg',
    //        //keeps from closing modal with esc key or by clicking out of the modal.
    //        // user must click cancel or X to close
    //        'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
    //    ]);
    //    echo "<div id='modalContent'></div>";
    //    yii\bootstrap\Modal::end();
    //
    ?>

    <?=
    Html::a('Edit person id=7', '#', [
        'title' => Yii::t('yii', 'Edit'),
        'onclick' =>
            "
$.ajax({
type     :'GET',
cache    : false,
//url  : '/work/web/person/create',
url  : '/work/web/person/update?id=7',
success  : function(response) {
$('.modal-body').html(response);
//$('#ajax-form').modal('show')
$('#myModal').modal('show')
}
});return false;",
    ]);

    ?>


    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Название модали</h4>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <!--                    <button type="button" class="btn btn-primary">Сохранить изменения</button>-->
                    <?= Html::button('Сохранить', ['class' => "btn btn-primary", 'onclick' => "
                    myForm=$('.person-form form');
$.ajax({
      url: myForm.attr('action'),
      type: 'post',
      data: myForm.serialize(),
      success: function(response) {
        $('.modal-body').html(response);
      }
    });
                    "]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
