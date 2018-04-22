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

        $question = new Question;
        $this->saveQuestion($question);
        
        return $this->render('petition', [
            'model' => $question, 'models' => $this->loadQuestions()
        ]);
    }

    private function saveQuestion($question) {
        if ($question->load(Yii::$app->request->post())) {
            if(!$question->validate()) {
                return null;
            }
            $question->user_id = Yii::$app->user->identity->id;
            $question->save();
            Yii::$app->session->setFlash('success', "Сообщение отправленно");
        }
    }

    private function loadQuestions() {
        $user = Yii::$app->user->identity->id;
        $models = Question::find()->where(['user_id' => $user])->all();
        return $models;
    }
}