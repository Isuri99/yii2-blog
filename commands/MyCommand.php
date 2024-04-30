<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

class MyCommand extends Controller

{
    public function actionIndex($userId, $roleName)
    {
        $authManager = Yii::$app->authManager;

        // Retrieve the user model
        $user = \app\models\User::findOne($userId);

        if (!$user) {
            echo "User with ID $userId not found." . PHP_EOL;
            return;
        }

        // Retrieve the role
        $role = $authManager->getRole($roleName);

        if (!$role) {
            echo "Role $roleName not found." . PHP_EOL;
            return;
        }

        // Assign role to user
        $authManager->assign($role, $user->id);

        echo "Role $roleName assigned to user with ID $userId." . PHP_EOL;
    }

}
