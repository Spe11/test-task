<?php

namespace app\modules;

use Yii;

/**
 * admin module definition class
 */
class Admin extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (Yii::$app->user->can('admin')) {
            throw new \yii\web\ForbiddenHttpException('Страница недоступна для пользователей');
        }

        return true;
    }
}
