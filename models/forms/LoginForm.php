<?php

namespace app\models\forms;

use app\models\Users;
use yii\base\Model;
use yii\web\NotFoundHttpException;

class LoginForm extends Model
{
    public $email;
    public $password;

    private $_user;

    /**
     * @return string[]
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'password' => 'Пароль'
        ];
    }

    /**
     * @return \array[][]
     */
    public function rules()
    {
        return [
            'safe' => [
                ['email', 'password'], 'safe'
            ],
            'required' => [
                ['email', 'password'], 'required',
                'message' => 'Обязательное поле'
            ],
            'email' => [
                ['email'], 'email',
                'message' => 'Введите существующий email'
            ],
            'password' => [
                ['password'], 'validatePassword'
            ]
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError('email', 'Неправильный email или пароль');
            }
        }
    }

    public function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Users::findOne(['email' => $this->email]);
        }

        return $this->_user;
    }


}