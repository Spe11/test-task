<?php

namespace app\modules\controllers;

use Yii;
use yii\web\Controller;
use app\models\Question;
use app\models\Answer;

class PetitionsController extends Controller
{
    public $defaultAction = 'all';

    public function actionAll()
    {
        $models = Question::find()->where(['status' => 0])->all();
        return $this->render('main', [
            'models' => $models
        ]);
    }

    public function actionAnswer($id) {
        $answer = new Answer;
        $this->saveAnswer($answer);
        $quest = Question::find()->where(['id' => $id])->one();
        return $this->render('petition', [
            'quest' => $quest, 'answer' => $answer
        ]);
    }

    public function actionClose() {
        
        $this->redirect(['petitions/all']);
    }

    private function saveAnswer($answer) {
        if(Yii::$app->request->isPost) {
            if ($answer->load(Yii::$app->request->post())) {
                if(!$answer->validate()) {
                    return null;
                }
                $answer->user_id = Yii::$app->user->identity->id;
                $answer->save();
                $this->closePetition($answer->question_id);
            }
            $this->redirect(['petitions/all']);
        }
    }

    private function closePetition($id) {
        $model = Question::find()->where(['id' => $id])->one();
        $model->status = 1;
        $model->save(false);
    }
}
