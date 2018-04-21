<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Answer extends ActiveRecord
{
    public static function tableName()
    {
        return 'answers';
    }

    public function rules()
    {
        return [
            [['text'], 'required', 'message' => 'Введите сообщение']
        ];
    }
}