<?php

namespace app\controllers;

use app\models\forms\CreateLotForm;
use app\models\Images;
use app\models\Lots;
use yii\web\Controller;
use yii\web\UploadedFile;

class LotsController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        $createForm = new CreateLotForm;

        if ($createForm->load(\Yii::$app->request->post())) {
            if ($createForm->validate()) {
                $lot = new Lots();
                $lot->dt_add = date('Y-m-d H:i:s');
                $lot->dt_end = $createForm->dt_end;
                $lot->user_id = \Yii::$app->user->identity->getId();
                $lot->name = $createForm->name;
                $lot->category_id = (int)$createForm->category;
                $lot->description = $createForm->description;
                $lot->price = (int)$createForm->price;
                $lot->step = (int)$createForm->step;

                $createForm->image = UploadedFile::getInstance($createForm, 'image');
                $file = $createForm->upload();

                if ($file) {
                    $imageFile = new Images();
                    $imageFile->name = $file;
                    $imageFile->path = 'uploads/' . $file;
                    $imageFile->save();
                    $lot->image_id = $imageFile->id;
                }

                $lot->save();
                if ($lot->save()) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('create', compact('createForm'));
    }

}
