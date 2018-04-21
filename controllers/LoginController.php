<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Authentication;

class LoginController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Authentication;
        $model->scenario = Authentication::SCENARIO_LOGIN;
        if ($model->load(Yii::$app->request->post())) {
            if($user = $model->login()) {
                if (Yii::$app->user->login($user)) {
                    return $this->goHome();
                }
            }
            else {
                Yii::$app->session->setFlash('failure', "Неверные имя или пароль");
           }
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
