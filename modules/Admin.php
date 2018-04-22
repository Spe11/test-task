<?php

namespace app\modules;

use Yii;
use yii\filters\AccessControl;

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

    public function behaviors()
    {
        return [
        'access' => [
            'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ]
                ],
                'denyCallback' => function($rule, $action){
                        throw new \yii\web\ForbiddenHttpException;
                }
            ],
        ];
    }
}