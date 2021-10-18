<?php

namespace app\controllers;

use app\models\forms\CreateLotForm;
use yii\web\Controller;

class LotsController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        $createForm = new CreateLotForm;

        return $this->render('create', compact('createForm'));
    }

}
