<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

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
}