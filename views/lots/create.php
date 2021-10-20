<?php
/**
 * @var CreateLotForm $createForm
 */

use app\models\Categories;
use app\models\forms\CreateLotForm;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\widgets\Pjax;

?>

<?php Pjax::begin() ?>
<?php $form = ActiveForm::begin([
    'method' => 'post',
    'options' => [
        'class' => 'form form--add-lot container', // form--invalid
        'data' => [
            'pjax' => true
        ]
    ]
]) ?>
    <h2>Добавление лота</h2>
    <div class="form__container-two">
        <?= $form->field($createForm, 'name', [
            'options' => ['class' => 'form__item'],
            'inputOptions' => ['placeholder' => 'Введите наименование лота']
        ]) ?>
        <?= $form->field($createForm, 'category', [
            'options' => ['class' => 'form__item']
        ])->dropdownList(Categories::find()->select(['name'])->indexBy('id')->column(), [
            'prompt' => 'Выберите категорию',
            'style' => 'color: #6a6a6a'
        ]) ?>
    </div>
    <div class="form__item form__item--wide">
        <?= $form->field($createForm, 'description')
            ->textarea(['placeholder' => 'Напишите описание лота']) ?>
    </div>
    <div class="form__item form__item--file">
        <?= $form->field($createForm, 'image', [
            'inputOptions' => [
                'type' => 'file'
            ]
        ])->fileInput() ?>
    </div>

    <div class="form__container-three">

        <?= $form->field($createForm, 'price', [
            'options' => [
                'class' => 'form__item form__item--small'
            ],
            'inputOptions' => ['placeholder' => '0']
        ]) ?>
        <?= $form->field($createForm, 'step', [
            'options' => [
                'class' => 'form__item form__item--small'
            ],
            'inputOptions' => ['placeholder' => '0']
        ]) ?>

        <div class="form__item">
            <?= $form->field($createForm, 'dt_end', [
                'inputOptions' => [
                    'type' => 'date'
                ]
            ]) ?>
        </div>
    </div>
<?= Html::submitButton('Добавить лот', ['class' => 'button']) ?>
<?php ActiveForm::end() ?>
<?php Pjax::end() ?>