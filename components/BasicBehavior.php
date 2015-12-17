<?php

namespace app\components;

use yii\base\Behavior;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;
use yii\validators\Validator;

class BasicBehavior extends Behavior
{
    public $txt, $id_field, $name_field, $classDir;
    /**
     * @var array
     */
    public $rules = [];

    /**
     * @var \yii\validators\Validator[]
     */
    protected $validators = []; // track references of appended validators

    /**
     * @inheritdoc
     */
    public function attach($owner)
    {
        parent::attach($owner);
        $validators = $owner->validators;
        foreach ($this->rules as $rule) {
            if ($rule instanceof Validator) {
                $validators->append($rule);
                $this->validators[] = $rule; // keep a reference in behavior
            } elseif (is_array($rule) && isset($rule[0], $rule[1])) { // attributes, validator type
                $validator = Validator::createValidator($rule[1], $owner, (array) $rule[0], array_slice($rule, 2));
                $validators->append($validator);
                $this->validators[] = $validator; // keep a reference in behavior
            } else {
                throw new InvalidConfigException('Invalid validation rule: a rule must specify both attribute names and validator type.');
            }
        }
        $owner->on(ActiveRecord::EVENT_BEFORE_INSERT, function () {
            $this->saveRelatedDir($this->txt, $this->id_field, $this->name_field, $this->classDir);
        });
        $owner->on(ActiveRecord::EVENT_BEFORE_UPDATE, function () {
            $this->saveRelatedDir($this->txt, $this->id_field, $this->name_field, $this->classDir);
        });
    }

    /**
     * @inheritdoc
     */
    public function detach()
    {
        $ownerValidators = $this->owner->validators;
        $cleanValidators = [];
        foreach ($ownerValidators as $validator) {
            if ( ! in_array($validator, $this->validators)) {
                $cleanValidators[] = $validator;
            }
        }
        $ownerValidators->exchangeArray($cleanValidators);
//        $this->owner->off()
    }

    public function saveRelatedDir($txt, $id_field, $name_field, $classDir)
    {
        $this->owner->$id_field=null;
        if (strlen($this->owner->$txt)){
            $model=$classDir::find()->where([$name_field=>$this->owner->$txt])->one();
            if(!$model){
                $model=new $classDir;
                $model->name=$this->owner->$txt;
                if(!$model->save()){
                    $this->addError($txt,'Не удалось сохранить новое значение');
                    return false;
                }
            }
            if($model){
                $this->owner->$id_field=$model->id;
            }
        }
        return true;
    }
}