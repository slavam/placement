<?php
use yii\helpers\Html;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
$this->title = 'Структура приложения';
$this->params['breadcrumbs'][] = $this->title;
?>


<?php
$structure = [
        'Cправочники'=>[
            'Статус записи'=>[
                'id',
                'Наименование',
                'Примечание',
                'Статус записи',
                'Кто добавил',
                'Дата добавления',
            ],
            'Пользователи'=>[
                'id',
                'Логин',
                'Пароль',
                'ФИО',
                'Фирма-работодатель',
                'E-mail',
                'Телефон',
            ],
        ]

/*    [
        'label' => 'Вакансии',
        'content' => [
                ['label' => 'Регион'],
                ['label' => 'Работиодатель'],
                ['label' => 'Должность'],
                ['label' => 'Оклад'],
                ['label' => 'Статус'],
                ['label' => 'Описание'],
        ],
    ],*/
];
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php

\yii\helpers\VarDumper::dump($structure,10,true);

return;

echo htmlTree($structure);

function htmlTree($tree) {
    $treeHtml = '<ul>';
    foreach ($tree as $val) {
        $treeHtml .= '<li>';
        if (is_array($val)) {
            $treeHtml .= key($val);
            $treeHtml .= htmlTree($val);
        }else{
            $treeHtml .= $val;
        }
        $treeHtml .= '</li>';
    }
    $treeHtml .= '</ul>';
    return $treeHtml;
}


//echo build_tree($structure,0);
function build_tree($cats,$parent_id,$only_parent = false){
    if(is_array($cats) and isset($cats[$parent_id])){
        $tree = '<ul>';
        if($only_parent==false){
            foreach($cats[$parent_id] as $cat){
                $tree .= '<li>'.$cat['name'].' #'.$cat['id'];
                $tree .=  build_tree($cats,$cat['id']);
                $tree .= '</li>';
            }
        }elseif(is_numeric($only_parent)){
            $cat = $cats[$parent_id][$only_parent];
            $tree .= '<li>'.$cat['name'].' #'.$cat['id'];
            $tree .=  build_tree($cats,$cat['id']);
            $tree .= '</li>';
        }
        $tree .= '</ul>';
    }
    else return null;
    return $tree;
}

/*function build_tree($cats,$parent_id,$only_parent = false){
    if(is_array($cats) and isset($cats[$parent_id])){
        $tree = '<ul>';
        if($only_parent==false){
            foreach($cats[$parent_id] as $cat){
                $tree .= '<li>'.$cat['name'].' #'.$cat['id'];
                $tree .=  build_tree($cats,$cat['id']);
                $tree .= '</li>';
            }
        }elseif(is_numeric($only_parent)){
            $cat = $cats[$parent_id][$only_parent];
            $tree .= '<li>'.$cat['name'].' #'.$cat['id'];
            $tree .=  build_tree($cats,$cat['id']);
            $tree .= '</li>';
        }
        $tree .= '</ul>';
    }
    else return null;
    return $tree;
}*/

/*echo Collapse::widget([
    'items' => [
        // equivalent to the above
        [
            'label' => 'Работодатели',
            'content' => [
                    'Регион',
                    'Работиодатель',
                    'Должность',
                    'Оклад',
                    'Статус',
                    'Описание',
            ],
            // open its content by default
            'contentOptions' => ['class' => 'in']
        ],
        // another group item
        [
            'label' => 'Collapsible Group Item #1',
            'content' => 'Anim pariatur cliche...',
        ],
        // if you want to swap out .panel-body with .list-group, you may use the following
        [
            'label' => 'Collapsible Group Item #1',
            'content' => [
                'Anim pariatur cliche...',
                'Anim pariatur cliche...'
            ],
            'footer' => 'Footer' // the footer label in list-group
        ],
    ]
]);*/

?>
<!--
<div class="site-about">
    <h1><? /*= Html::encode($this->title) */ ?></h1>
    <ul>
        <li>Работодатели
            <ul>
                <li>Вакансии
                    <ul>
                        <li>Регион</li>
                        <li>Работодатель</li>
                        <li>Должность</li>
                        <li>Оклад</li>
                        <li>Статус</li>
                        <li>Описание</li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</div>
-->