<?php
/* @var $this yii\web\View */
$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Добро пожаловать!</h1>
        <?php if(Yii::$app->user->isGuest){?>
            <p class="lead">Для продолжения Вам необходимо войти в систему.</p>

            <p><a class="btn btn-lg btn-success" href="<?php echo Yii::$app->urlManager->createUrl(['site/login']) ?>">Войти</a></p>

        <?php }?>
    </div>

    <?php if(!Yii::$app->user->isGuest){?>
    <?php $menu=\app\models\MainMenu::getItems(); ?>

        <div class="body-content">

            <div class="row">
                <div class="col-lg-4">
                    <h2>Справочники</h2>
                    <div id="manager-menu" class="list-group">
                        <?php
                        foreach ($menu['dir'] as $menu_item) {
                            $label = \yii\helpers\Html::tag('i', '', ['class' => 'glyphicon glyphicon-chevron-right pull-right']) .
                                \yii\helpers\Html::tag('span', \yii\helpers\Html::encode($menu_item['label']), []);
                            $disabled = $menu_item['visible']?'':' disabled';
                            echo \yii\helpers\Html::a($label, ($disabled?'#':$menu_item['url']), [
                                'class' => 'list-group-item' . $disabled,
                            ]);
                        }
                        ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h2>Данные</h2>
                    <div id="manager-menu" class="list-group">
                        <?php
                        foreach ($menu['data'] as $menu_item) {
                            $label = \yii\helpers\Html::tag('i', '', ['class' => 'glyphicon glyphicon-chevron-right pull-right']) .
                                \yii\helpers\Html::tag('span', \yii\helpers\Html::encode($menu_item['label']), []);
                            $disabled = $menu_item['visible']?'':' disabled';
                            echo \yii\helpers\Html::a($label, ($disabled?'#':$menu_item['url']), [
                                'class' => 'list-group-item' . $disabled,
                            ]);
                        }
                        ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h2>Документы</h2>
                    <div id="manager-menu" class="list-group">
                        <?php
                        foreach ($menu['doc'] as $menu_item) {
                            $label = \yii\helpers\Html::tag('i', '', ['class' => 'glyphicon glyphicon-chevron-right pull-right']) .
                                \yii\helpers\Html::tag('span', \yii\helpers\Html::encode($menu_item['label']), []);
                            $disabled = $menu_item['visible']?'':' disabled';
                            echo \yii\helpers\Html::a($label, ($disabled?'#':$menu_item['url']), [
                                'class' => 'list-group-item' . $disabled,
                            ]);
                        }
                        ?>
                    </div>
                </div>
                <?php if (Yii::$app->user->can('admin')){ ?>
                    <div class="col-lg-4">
                        <h2>Отчеты</h2>
                        <div id="manager-menu" class="list-group">
                            <?php
                            foreach ($menu['report'] as $menu_item) {
                                $label = \yii\helpers\Html::tag('i', '', ['class' => 'glyphicon glyphicon-chevron-right pull-right']) .
                                    \yii\helpers\Html::tag('span', \yii\helpers\Html::encode($menu_item['label']), []);
                                $disabled = $menu_item['visible']?'':' disabled';
                                echo \yii\helpers\Html::a($label, ($disabled?'#':$menu_item['url']), [
                                    'class' => 'list-group-item' . $disabled,
                                ]);
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <h2>Прочее</h2>
                        <div id="manager-menu" class="list-group">
                            <?php
                            foreach ($menu['other'] as $menu_item) {
                                $label = \yii\helpers\Html::tag('i', '', ['class' => 'glyphicon glyphicon-chevron-right pull-right']) .
                                    \yii\helpers\Html::tag('span', \yii\helpers\Html::encode($menu_item['label']), []);
                                $disabled = $menu_item['visible']?'':' disabled';
                                echo \yii\helpers\Html::a($label, ($disabled?'#':$menu_item['url']), [
                                    'class' => 'list-group-item' . $disabled,
                                ]);
                            }
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>

    <?php }?>
</div>
