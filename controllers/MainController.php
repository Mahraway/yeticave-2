<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\SignupForm;
use app\models\Users;

class MainController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $loginForm = new LoginForm();

        if (\Yii::$app->request->getIsPost()) {
            $loginForm->load(\Yii::$app->request->post());
            if ($loginForm->validate()) {
                $user = $loginForm->getUser();
                if ($user) {
                    \Yii::$app->user->login($user);
                    return $this->goHome();
                }
            }
            return $this->render('login', [
                'loginForm' => $loginForm
            ]);
        }
        return $this->render('login', [
            'loginForm' => $loginForm
        ]);
    }

    public function actionLogout()
    {
        if (!\Yii::$app->user->isGuest) {
            \Yii::$app->user->logout();
            return $this->goHome();
        }
    }

    public function actionSignup(): string
    {
        $signupForm = new SignupForm();

        if (\Yii::$app->request->isPost) {
            $signupForm->load(\Yii::$app->request->post());
            if ($signupForm->validate()) {
                $user = new Users();

                $user->dt_add = date('Y-m-d H:i:s');
                $user->email = $signupForm->email;
                $user->name = $signupForm->name;
                $user->contacts = $signupForm->contacts;
                $user->password = \Yii::$app->getSecurity()->generatePasswordHash($signupForm->password);

                if ($user->save()) {
                    $this->redirect('/pages/all-lots.html');
                }
            }
        }

        return $this->render('signup',[
            'signupForm' => $signupForm
        ]);
    }
}
