<?php

namespace app\models;

use Yii;

/**
 */
class MainMenu
{
    public static function getItems()
    {

//        $key = Yii::$app->user->id . '_menu_items';
//
//        Yii::$app->cache->delete($key);
//        $data = Yii::$app->cache->get($key);
        $data = false;
        if ($data === false) {
            $data = [
                'dir' => [
                    ['label' => Yii::t('app', 'Users'), 'url' => ['/user/index'], 'visible' => Yii::$app->user->can('/user/index')],
                    ['label' => Yii::t('app', 'Access'), 'url' => ['/admin'], 'visible' => Yii::$app->user->can('admin')],
                    ['label' => Yii::t('app', 'Rec Statuses'), 'url' => ['/rec-status/index'], 'visible' => Yii::$app->user->can('/rec-status/index')],
                    ['label' => Yii::t('app', 'Resume Statuses'), 'url' => ['/resume-status/index'], 'visible' => Yii::$app->user->can('/resume-status/index')],
                    ['label' => Yii::t('app', 'Professions'), 'url' => ['/profession/index'], 'visible' => Yii::$app->user->can('/profession/index')],
                    ['label' => Yii::t('app', 'Cities'), 'url' => ['/city/index'], 'visible' => Yii::$app->user->can('/city/index')],
                    ['label' => Yii::t('app', 'Firms'), 'url' => ['/firm/index'], 'visible' => Yii::$app->user->can('/firm/index')],
                    ['label' => Yii::t('app', 'Workplaces'), 'url' => ['/workplace/index'], 'visible' => Yii::$app->user->can('/workplace/index')],
                    ['label' => Yii::t('app', 'Regions'), 'url' => ['/region/index'], 'visible' => Yii::$app->user->can('/region/index')],
                ],
                'data' => [
                    ['label' => Yii::t('app', 'Vacancies'), 'url' => ['/vacancy/index'], 'visible' => Yii::$app->user->can('/vacancy/index')],
                    ['label' => Yii::t('app', 'Resume'), 'url' => ['/resume/index'], 'visible' => Yii::$app->user->can('/resume/index')],
                    ['label' => Yii::t('app', 'Addresses'), 'url' => ['/address/index'], 'visible' => Yii::$app->user->can('/address/index')],
                    ['label' => Yii::t('app', 'Resume Professions'), 'url' => ['/resume-profession/index'], 'visible' => Yii::$app->user->can('/resume-profession/index')],
                    ['label' => Yii::t('app', 'People'), 'url' => ['/person/index'], 'visible' => Yii::$app->user->can('/person/index')],
                    ['label' => Yii::t('app', 'Experiences'), 'url' => ['/experience/index'], 'visible' => Yii::$app->user->can('/experience/index')],
                    ['label' => Yii::t('app', 'Educations'), 'url' => ['/education/index'], 'visible' => Yii::$app->user->can('/education/index')],
//                    ['label' => Yii::t('app', 'Docs'), 'url' => ['/doc/index'], 'visible' => Yii::$app->user->can('/doc/index')],
                    ['label' => Yii::t('app', 'Files'), 'url' => ['/file/index'], 'visible' => Yii::$app->user->can('/file/index')],
                ],
                'doc' => [
                    ['label' => Yii::t('app', 'Inn'), 'url' => ['/doc-inn/index'], 'visible' => Yii::$app->user->can('/doc-inn/index')],
                    ['label' => Yii::t('app', 'Passport'), 'url' => ['/doc-passport/index'], 'visible' => Yii::$app->user->can('/doc-passport/index')],
                    ['label' => Yii::t('app', 'Medical'), 'url' => ['/doc-medical/index'], 'visible' => Yii::$app->user->can('/doc-medical/index')],
                    ['label' => Yii::t('app', 'Patent'), 'url' => ['/doc-patent/index'], 'visible' => Yii::$app->user->can('/doc-patent/index')],
                    ['label' => Yii::t('app', 'Exam'), 'url' => ['/doc-exam/index'], 'visible' => Yii::$app->user->can('/doc-exam/index')],
                    ['label' => Yii::t('app', 'Migration'), 'url' => ['/doc-migration/index'], 'visible' => Yii::$app->user->can('/doc-migration/index')],
                    ['label' => Yii::t('app', 'Registration'), 'url' => ['/doc-registration/index'], 'visible' => Yii::$app->user->can('/doc-registration/index')],
                ],
                'report' => [
                    ['label' => Yii::t('app', 'Общий отчет'), 'url' => ['/report/1'], 'visible' => Yii::$app->user->can('admin')], //'/report/1')],
                ],
                'other' => [
                    ['label' => Yii::t('app', 'История общения с соискателями и работодателями'), 'url' => ['/site/report/2'], 'visible' => Yii::$app->user->can('/site/report/2')],
                    ['label' => Yii::t('app', 'Обмен сообщениями между пользователями'), 'url' => ['/site/report/3'], 'visible' => Yii::$app->user->can('/site/report/3')],
                    ['label' => Yii::t('app', 'Удалить скешированные данные'), 'url' => ['/site/delete-cache'], 'visible' => Yii::$app->user->can('/site/delete-cache')],
                    ['label' => Yii::t('app', 'Лог действий пользователей'), 'url' => ['/report/0'], 'visible' => Yii::$app->user->can('/report/0')],
                    ['label' => Yii::t('app', 'Процесс разработки'), 'url' => ['/site/what-do'], 'visible' => Yii::$app->user->can('/site/what-do')],
//                    ['label' => Yii::t('app', 'Импорт данных из файла'), 'url' => ['/report/0'], 'visible' => Yii::$app->user->can('/report/0')],
//                    ['label' => Yii::t('app', 'Скачать файл-бланк'), 'url' => ['/report/0'], 'visible' => Yii::$app->user->can('/report/0')],
                ],
            ];
//            Yii::info(\yii\helpers\Json::encode($key));
//            Yii::$app->cache->set($key, $data, 3600);
        }

//        $result = Profession::getDb()->cache(function ($db) {
//            return Profession::find()->where(['id' => 1])->one();
//        });
//        $ff = Profession::find()->where(['id' => 1])->one();

        return $data;
    }
}
