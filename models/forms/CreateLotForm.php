<?php

namespace app\models\forms;

use app\models\Images;
use yii\base\Model;

class CreateLotForm extends Model
{
    public $name;
    public $category;
    public $description;
    public $image;
    public $price;
    public $step;
    public $dt_end;

    public function attributeLabels()
    {
        return [
            'name' => 'Наименование',
            'category' => 'Категория',
            'description' => 'Описание',
            'image' => 'Изображение',
            'price' => 'Начальная цена',
            'step' => 'Шаг ставки',
            'dt_end' => 'Дата окончания торгов'
        ];
    }

    public function rules()
    {
        return [
            'safe' => [
                [
                    'name',
                    'category',
                    'description',
                    'image',
                    'price',
                    'step',
                    'dt_end'
                ], 'safe'
            ],
            'required' => [
                [
                    'name',
                    'category',
                    'description',
                    'price',
                    'step',
                    'dt_end'
                ], 'required',
                'message' => 'Обязательное поле'
            ],
            'file' => [
                ['image'], 'file', 'extensions' => 'png, jpg'
            ]
        ];
    }

    /**
     * @return bool
     */
    public function upload()
    {
        if ($this->validate()) {
            $fileName = uniqid() . '.' . $this->image->extension;
            $this->image->saveAs('uploads/' . $fileName);
            return $fileName;
        } else {
            return false;
        }
    }
}