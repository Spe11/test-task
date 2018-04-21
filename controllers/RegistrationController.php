<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\models\Authentication;

class RegistrationController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Authentication;
        $model->scenario = Authentication::SCENARIO_REGISTER;
        if ($model->load(Yii::$app->request->post())) {
            if($user = $model->register()) {
                if (Yii::$app->user->login($user)) {
                    return $this->goHome();
                } 
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }
}
