<?php

namespace app\components;

use yii\rbac\Rule;

/**
 * Checks if userID matches user passed via params
 */
class AccessFilter extends Rule
{
    public $name = 'AccessFilter';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        if (isset($params['model'])){
            if($params['model']->user_id == $user)
                return true;

            if (isset($params['model']->workplace_id)){
                $user_workplace=\Yii::$app->user->identity->workplace_id;
                if($params['model']->workplace_id == $user_workplace)
                    return true;
            }
            return false;
        }
        return true;
    }
}