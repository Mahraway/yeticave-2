<?php

namespace app\models\forms;

use yii\base\Model;

class CreateLotForm extends Model
{
    public $name;
    public $description;
    public $image;
    public $price;
    public $step;
    public $dt_add;
    public $dt_end;
}