<?php 

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Question;

class PetitionController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
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

    public function actionIndex() {
        $model = new Question;
        
        if ($model->load(Yii::$app->request->post())) {
            if(!$model->validate()) {
                return null;
            }
            $model->user_id = Yii::$app->user->identity->id;
            $model->save();
            Yii::$app->session->setFlash('success', "Сообщение отправленно");
        }
        
        return $this->render('petition', [
            'model' => $model
        ]);
    }
}