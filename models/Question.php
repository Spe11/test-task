<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\Answer;

class Question extends ActiveRecord
{
    public static function tableName()
    {
        return 'questions';
    }

    public function rules()
    {
        return [
            [['text'], 'required', 'message' => 'Введите сообщение']
        ];
    }

    public function attributeLabels()
    {
        return [
            'text' => ''
        ];
    }

    public function getName() {
        return 'Обращение номер '.$this->id;
    }

    public function getInfo() {
        return $this->status == 0 ? 'Открыто' : 'Закрыто';
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getAnswer()
    {
        return $this->hasOne(Answer::className(), ['question_id' => 'id']);
    }

    public function getQuestionTextEng() {
        $text = Yii::$app->translator->toEng($this->user->language, $this->text);
        return 'Текст обращения: '.$text;
    }

    public function getQuestionText() {
        return 'Текст обращения: '.$this->text;
    }

    public function getAnswerText()
    {
        if($this->status === 1) {
            $text = Yii::$app->translator->toCustom($this->user->language, $this->answer->text);
             return 'Ответ: '.$text;
        }
        return '';
    }
}