<?php 

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Question;
use yii\data\ActiveDataProvider;

class PetitionController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function actionIndex() {
        if(Yii::$app->user->isGuest) {;
            Yii::$app->session->setFlash('warning', "Доступо только для пользователей");
        }

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
            'model' => $model, 'models' => $this->loadPetitions()
        ]);
    }

    private function loadPetitions() {
        $user = Yii::$app->user->identity->id;
        $models = Question::find()->where(['user_id' => $user])->all();
        return $models;
    }
}