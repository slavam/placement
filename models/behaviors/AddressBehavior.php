<?php

namespace app\models\behaviors;

use app\components\BasicBehavior;
use app\models\Address;

class AddressBehavior extends BasicBehavior
{
    public function saveRelatedDir($txt, $id_field, $name_field, $classDir)
    {
        $id = $this->owner->$id_field;
        $model = $id ? Address::findOne($id) : new $classDir;
        if ($model->load(\Yii::$app->request->post())) {
            if (!$model->save()) {
                $this->addError($id_field, 'Не удалось сохранить новое значение');
                return false;
            }
            $this->owner->$id_field = $model->id;
            return true;
        }
    }
}