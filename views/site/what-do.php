<?php
/**
 * http://www.mail.nic.ru/
 * work@com-style.su
 * 53cQeLrMNPPzZ
 * work-com-style.16mb.com
 *
 * ftp.work-com-style.16mb.com
 * Пароль для нового FTP пользователя u241974972.work установлен 53cQeLrMNPPzZ
 *
 * Детали тикета
 * https://cpanel.hostinger.ru/public/ticket/id/178eea13f91e57e35ad6fed70d1d256970ac4a1f
 *
 *
 * Программа для управления пректами Redmine. Почитать
 */

use \yii\helpers;

/* @var $this yii\web\View */
$this->title = 'Процесс разработки';
$this->params['breadcrumbs'][] = $this->title;

?>

<?php

//echo date('d.m.Y H:i:s').'<br>';
//echo Yii::$app->getFormatter()->asDatetime(time());

?>


<div class="panel panel-warning">
    <div class="panel-heading">Что нужно сделать, заметки, мелкие исправления</div>
    <div class="panel-body">
        <ul>
            <li>Резюме: Если неверно указан формат Даты рождения, то не проходит валидация. После сабмита форма возвращается без полей ФИО и Адрес (скорее всего связано с элементом управления).</li>
            <li><strike>Во всех моделях встроить проверку на целостность данных перед удалением записи по связям, если таблица MyISAM. Или решить этот вопрос созданием триггеров в БД.</strike></li>
            <li><strike>Резюме: при включенной "жадной загрузке" неверно определяется количество записей</strike></li>
            <li><b>Проверить адрес в фирмах и людях. При непрошедшей валидации поля город и регион должны сохранять
                    введеное значение. "person/edit" </b></li>
            <li>Сделать типизированные метки с доп. информацией на сделки, резюме и реализовать возможность
                поиска/фильтрации по ним (возможно на базе истории общения с клиентами)
            </li>
            <li>Резюме: сделать группировку должностей по группам в списке</li>
            <ul>
                <li>Должности: добавить поле "Раздел, Отрасль, Направление, Группа или т.п." в справочник должностей для
                    группировки значений в списках
                </li>
                <li>Добавить новый справочник "Группа должностей"</li>
            </ul>
            <li>Расширенные фильтры по всем полям объекта на страницах "index"</li>
            <li>Доступ:</li>
            <ul>
                <li>Фильтр для группы "user":</li>
                <ul>
                    <li><strike>Вакансии: только те записи, которые принадлежат текущему пользователю либо его рабочему месту
                    </strike></li>
                    </li>
                    <li>Спрятать поля "Пользователь", "Дата ввода", "Состояние записи" для всех объектов</li>
                </ul>
            </ul>
            <li>Придумать что-нибудь с валидацией обязательных подчиненных полей (например Регион, Город в блоке
                "Адрес" если адрес не обязателен для текущего объекта)
            </li>
            <li>Вакансии:</li>
            <ul>
                <li>Вакансии: переделать поле выбора фирмы с выпадающего списка на автопоиск по наименованию и окпо
                    Ajax <?= helpers\Html::a('(образец)', 'http://demos.krajee.com/widget-details/select2') ?></li>
                <li>Вакансии: переделать поле выбора должности с выпадающего списка на автодобавление нового значения
                </li>
            </ul>
        </ul>
    </div>
</div>


<div class="panel panel-success">
    <div class="panel-heading">Что сделано</div>
    <div class="panel-body">

        <div class="site-what-do">
            <h4><span class="label label-default">19.07.2015</span></h4>
            <ul>
                <li>Сделал фильтрацию записей для ограниченного пользователя по рабочему месту и id пользователя:</li>
                <ul>
                    <li>Доступны только те записи, которые добавлял пользователь, либо добавляли с того же рабочего места, на котором работает пользователь</li>
                </ul>
            </ul>
            </ul>
        </div>
        <hr>

        <div class="site-what-do">
            <h4><span class="label label-default">17.07.2015</span></h4>
            <ul>
                <li>Прикрепление сканкопий к резюме<?= helpers\Html::a('(посмотреть)', ['/resume/view', 'id' => \app\models\Resume::find('id>0')->one()->id]) ?></li>
            </ul>
            </ul>
        </div>
        <hr>

        <div class="site-what-do">
            <h4><span class="label label-default">16.07.2015</span></h4>
            <ul>
                <li>Документы: сделал свой набор полей для регистрации<?= helpers\Html::a('(посмотреть)', ['/resume/view', 'id' => \app\models\Resume::find('id>0')->one()->id]) ?></li>
            </ul>
            </ul>
        </div>
        <hr>

        <div class="site-what-do">
            <h4><span class="label label-default">14.07.2015 - 15.07.2015</span></h4>
            <ul>
                <li>Документы: для каждого документа сделал свой набор полей (осталось сделать для регистрации)<?= helpers\Html::a('(посмотреть)', ['/resume/view', 'id' => \app\models\Resume::find('id>0')->one()->id]) ?></li>
            </ul>
            </ul>
        </div>
        <hr>

        <div class="site-what-do">
            <h4><span class="label label-default">12.07.2015 - 13.07.2015</span></h4>
            <ul>
                <li>Люди: добавил блок "Документы" <?= helpers\Html::a('(посмотреть)', ['/person/view', 'id' => \app\models\Person::find('id>0')->one()->id]) ?></li>
                <li>Резюме: добавил блок "Документы" <?= helpers\Html::a('(посмотреть)', ['/resume/view', 'id' => \app\models\Resume::find('id>0')->one()->id]) ?></li>
                <li>Добавил блок "Документы" <?= helpers\Html::a('(посмотреть)', ['/doc/index']) ?></li>
            </ul>
            </ul>
        </div>
        <hr>

        <div class="site-what-do">
            <h4><span class="label label-default">08.07.2015</span></h4>
            <ul>
                <li>Резюме и Люди: переделал блоки "Опыт работы" и "Образование" <?= helpers\Html::a('(посмотреть)', ['/resume/view', 'id' => \app\models\Resume::find('id>0')->one()->id]) ?></li>
            </ul>
        </div>
        <hr>

        <div class="site-what-do">
            <h4><span class="label label-default">07.07.2015</span></h4>
            <ul>
                <li>Резюме: добавил блоки "Опыт работы" и "Образование". Результат не нравится. Пока что временный вариант. Буду переделывать <?= helpers\Html::a('(посмотреть)', ['/resume/view', 'id' => \app\models\Resume::find('id>0')->one()->id]) ?></li>
                <li>Добавил блок "Образование" <?= helpers\Html::a('(посмотреть)', ['/education/index']) ?></li>
                <li>Добавил блок "Опыт работы" <?= helpers\Html::a('(посмотреть)', ['/experience/index']) ?></li>
            </ul>
        </div>
        <hr>

        <div class="site-what-do">
            <h4><span class="label label-default">06.07.2015</span></h4>
            <ul>
                <li>Резюме: добавил подробную информацию о соискателе <?= helpers\Html::a('(посмотреть)', ['/resume/view', 'id' => \app\models\Resume::find('id>0')->one()->id]) ?></li>
                <li>Резюме: добавил на форму данные соискателя + валидация при сабмите <?= helpers\Html::a('(посмотреть)', ['/resume/create']) ?></li>
                <li>Добавил флеш сообщения после успешного/неуспешного действия с
                    записью <?= helpers\Html::a('(посмотреть)', ['/rec-status/update', 'id' => 1]) ?></li>
                <li>Во всех блоках добавил кнопки действий <?= helpers\Html::a('(посмотреть)', ['/rec-status/view', 'id' => 1]) ?></li>
            </ul>
        </div>
        <hr>

        <div class="site-what-do">
            <h4><span class="label label-default">05.07.2015</span></h4>
            <ul>
                <li>Во всех блоках переделал страницы "index" с использованием Pjax (все таблицы обновляются
                    ajax'ом) <?= helpers\Html::a('(посмотреть)', ['/firm/index']) ?></li>
                <li>Люди: переделал поля "Фамилия", "Имя", "Отчество". Поиск по полям работает более
                    корректно <?= helpers\Html::a('(посмотреть)', ['/person/create']) ?></li>
                <li>Адрес: переделал поля "Город" и "Регион". Поиск по полям работает более
                    корректно <?= helpers\Html::a('(посмотреть)', ['/address/create']) ?></li>
                <li>Резюме: отредактировал форму ввода (подключил календари, поиск соискателя по
                    ФИО) <?= helpers\Html::a('(посмотреть)', ['/resume/create']) ?></li>
                <li>Проверить хостинг. Отрубили за нагрузку на
                    сервак <?= helpers\Html::a('(Тикет в техподдержку)', 'https://cpanel.hostinger.ru/public/ticket/id/178eea13f91e57e35ad6fed70d1d256970ac4a1f') ?></li>
                <ul>
                    <li>Не дождался ответа, зарегистрировал новый.</li>
                </ul>
            </ul>
        </div>
        <hr>

        <div class="site-what-do">
            <h4><span class="label label-default">04.07.2015</span></h4>
            <ul>
                <li>Заготовка CRUD операций под блок
                    "Люди" <?= helpers\Html::a('(посмотреть)', ['/person/index']) ?></li>
                <li>Список резюме и вакансий: реализовал "жадную загрузку" для уменьшения количества запросов к БД</li>
                <li>Список резюме и вакансий: добавил информацию о количестве записей на
                    странице <?= helpers\Html::a('(посмотреть)', ['resume/index']) ?> </li>
                <li>Резюме: переделал поле выбора должности с мультиселекта на поле с множественным
                    автопоиском <?= helpers\Html::a('(посмотреть)', ['resume/create']) ?> </li>
                <li>Резюме: выбор нескольких желаемых должностей в форме
                    ввода <?= helpers\Html::a('(посмотреть)', ['/resume/create']) ?></li>
            </ul>
            </ul>
        </div>
        <hr>

        <div class="site-what-do">
            <h4><span class="label label-default">02.07.2015</span></h4>
            <ul>
                <li>Переделал поле "Состояние записи" с выпадающего списка на переключатель во всех
                    объектах <?= helpers\Html::a('(посмотреть)', ['/vacancy/create']) ?> </li>
                <li>Заготовка CRUD операций под блок
                    "Резюме" <?= helpers\Html::a('(посмотреть)', ['/resume/index']) ?></li>
                <li>Вакансии: автоподстановка названия фирмы в вакансию из справочника пользователей, если в профиле
                    указана фирма-работодатель
                </li>
                <li>Вакансии: автоподстановка рабочего места в вакансию из справочника пользователей</li>
                <ul>
                    <li>Добавить в справочник пользователей поле "Рабочее место" для привязки записей в блоках
                        "Вакансии" и
                        "Резюме"
                    </li>
                </ul>
                <li>Добавил возможность удалить все скешированные данные по требованию пользователя (Меню -> Прочее ->
                    Удалить скешированные данные)
                </li>
                <li>Добавил страницу "Процесс разработки"</li>
            </ul>
            </ul>
        </div>
        <hr>

        <div class="site-what-do">
            <h4><span class="label label-default">01.07.2015</span></h4>
            <ul>
                <li>Переадресация на предыдущую страницу при "create" и "update", а не на "view" во всех
                    справочниках <?= helpers\Html::a('(посмотреть)', ['/city/create']) ?>
                </li>
                <li>Вакансии: если поле дата не заполнено, то подставляем сегодняшнюю
                    дату <?= helpers\Html::a('(посмотреть)', ['/vacancy/create']) ?></li>
                <li>Подключить блок "Адрес" в справочник
                    "Фирмы" <?= helpers\Html::a('(посмотреть)', ['/firm/create']) ?></li>
                <li>Подключить блок "Адрес" в справочник "Рабочее
                    место" <?= helpers\Html::a('(посмотреть)', ['/workplace/create']) ?></li>
                <li>Исправил ошибку: при непрошедшей валидации в справочнике фирм и справочнике рабочих мест поля,
                    относящиеся к
                    адресу теряли введенное значение
                </li>
                <li>Дизайн страницы со списком вакансий <?= helpers\Html::a('(посмотреть)', ['/vacancy/index']) ?></li>
                <li>Ограничил время сессии 1 часом бездействия</li>
            </ul>
            </ul>
        </div>
        <hr>

        <div class="site-what-do">
            <h4><span class="label label-default">30.06.2015</span></h4>
            <ul>
                <li>Блоки:</li>
                <ul>
                    <li>Адреса <?= helpers\Html::a('(посмотреть)', ['/address/index']) ?></li>
                    <li>Вакансии <?= helpers\Html::a('(посмотреть)', ['/vacancy/index']) ?></li>
                    <li>Авторизация</li>
                    <li>Доступ пользователей <?= helpers\Html::a('(посмотреть)', ['/admin/role']) ?></li>
                </ul>
            </ul>
            </ul>
        </div>
        <hr>

        <div class="site-what-do">
            <h4><span class="label label-default">29.06.2015</span></h4>
            <ul>
                <li>Главное меню</li>
                <li>Блоки:</li>
                <ul>
                    <li>Пользователи <?= helpers\Html::a('(посмотреть)', ['/user/index']) ?></li>
                    <li>Состояние записей <?= helpers\Html::a('(посмотреть)', ['/rec-status/index']) ?></li>
                    <li>Статус резюме <?= helpers\Html::a('(посмотреть)', ['/resume-status/index']) ?></li>
                    <li>Профессии <?= helpers\Html::a('(посмотреть)', ['/profession/index']) ?></li>
                    <li>Населенные пункты <?= helpers\Html::a('(посмотреть)', ['/city/index']) ?></li>
                    <li>Фирмы <?= helpers\Html::a('(посмотреть)', ['/firm/index']) ?></li>
                    <li>Рабочие места <?= helpers\Html::a('(посмотреть)', ['/workplace/index']) ?></li>
                    <li>Регионы <?= helpers\Html::a('(посмотреть)', ['/region/index']) ?></li>
                </ul>
            </ul>
        </div>
        <hr>

        <div class="site-what-do">
            <h4><span class="label label-default">26.06.2015 - 28.06.2015</span></h4>
            <ul>
                <li>Подготовка хостинга</li>
                <li>Разработка структуры БД</li>
                <li>Ориентировочный рассчет сроков и стоимости разработки ПО</li>
            </ul>
            </ul>
        </div>
    </div>
</div>

