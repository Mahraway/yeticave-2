<?php

namespace app\models;

use yii\base\Model;

class SignupForm extends Model
{
    public $email;
    public $password;
    public $name;
    public $contacts;

    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'password' => 'Пароль',
            'name' => 'Имя',
            'contacts' => 'Контактные данные'
        ];
    }

    public function rules()
    {
        return [
            'safe' => [
              ['email', 'password', 'name', 'contact'], 'safe'
            ],
            'required' => [
                ['email', 'password', 'name', 'contacts'], 'required',
                'message' => 'Обязательное поле'
            ],
            'unique' => [
                'email', 'unique',
                'targetClass' => 'app\models\Users',
                'message' => 'Пользователь с таким e-mail уже существует'
            ],
            'forContacts' => [
                ['contacts'], 'forContacts'
            ],
            'email' => [
                ['email'], 'email',
                'message' => 'Неверный Email'
            ],
            'password' => [
                'password', 'string',
                'min' => 8,
                'tooShort' => 'Длина пароля от 8 символов'
            ]

        ];
    }

    public function forContacts()
    {
        if (strlen($this->contacts) < 30) {
            $this->addError('contacts', 'Содержимое поля должно быть не менее 30 символов');
        }
    }
}