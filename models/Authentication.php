<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Authentication extends Model
{
    const SCENARIO_LOGIN = 'login';
    const SCENARIO_REGISTER = 'register';

    public $username;
    public $password;
    public $mail;
    public $rememberMe = true;

    public function scenarios()
    {
        return [
            self::SCENARIO_LOGIN => ['username', 'password'],
            self::SCENARIO_REGISTER =>  ['username', 'password', 'mail']
        ];
    }

    public function rules()
    {
        return [
            [['username', 'password', 'mail'], 'required', 'message' => 'Поле должно быть заполнено'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Имя уже занято',
                'on' => self::SCENARIO_REGISTER],
            ['mail', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Почта уже занята',
                'on' => self::SCENARIO_REGISTER],
            ['username', 'string', 'min' => 5, 'tooShort' => 'Имя должно содержать больше 5 символов',
                'on' => self::SCENARIO_REGISTER],
            ['password', 'required'],
            ['password', 'string', 'min' => 5, 'tooShort' => 'Пароль должно содержать больше 5 символов',
                'on' => self::SCENARIO_REGISTER],
            ['rememberMe', 'boolean'],
            ['mail', 'email', 'message' => 'Некоррретная почта'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
            'mail' => 'Почта',
            'rememberMe' => 'Запомнить',
        ];
    }

    public function login()
    {
        if (!$this->validate()) {
            return null;
        }

        if($user = User::findByUsername($this->username)) {
            if($user->validatePassword($this->password)) {
                return $user;
            }
        } else return null;
    }

    public function register()
    {
        if ($this->validate()) {
            $user = new User;
            $user->username = $this->username;
            $user->mail = $this->mail;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            return $user->save() ? $user : null;
        }
        return false;
    }

    public function getUser()
    {
        if ($this->user === false) {
            $this->user = User::findByUsername($this->username);
        }
        return $this->user;
    }
}
