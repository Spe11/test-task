<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\User;

class RbacController extends Controller 
{
    public function actionInit() {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        $role = $auth->createRole('admin');
        $auth->add($role);
        $auth->assign($role, User::findByUsername('admin')->id);
    }
}