<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (!Yii::$app->user->isGuest) {
        $menu = \app\models\MainMenu::getItems();
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Справочники', 'items' => $menu['dir']],
                ['label' => 'Данные', 'items' => $menu['data']],
                ['label' => 'Документы', 'items' => $menu['doc']],
                ['label' => 'Отчеты', 'items' => $menu['report']],
                ['label' => 'Прочее', 'items' => $menu['other']],
            ]
        ]);
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'О продукте', 'url' => ['/site/about']],
            Yii::$app->user->isGuest ?
                ['label' => 'Войти', 'url' => ['/site/login']] :
                ['label' => 'Выход (' . Yii::$app->user->identity->name . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php
echo \kartik\alert\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\alert\AlertBlock::TYPE_GROWL,
    'alertSettings' => [
        'error' => [
            'delay'=>10,
            'title' => 'Ошибка',
            'type' => \kartik\growl\Growl::TYPE_DANGER,
            'showSeparator' => true,
            'icon' => 'glyphicon glyphicon-exclamation-sign',
            'pluginOptions' => [
                'placement' => [
                    'from' => 'top',
                    'align' => 'right',
                ]
            ],
        ],
        'success' => [
            'delay'=>10,
            'title' => 'Успех',
            'type' => \kartik\growl\Growl::TYPE_SUCCESS,
            'showSeparator' => true,
            'icon' => 'glyphicon glyphicon-ok-sign',
            'pluginOptions' => [
                'placement' => [
                    'from' => 'top',
                    'align' => 'right',
                ]
            ],
        ],
    ],
]);?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
