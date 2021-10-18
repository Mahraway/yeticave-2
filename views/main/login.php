<?php
/**
 * @var $loginForm \app\models\LoginForm;
 */

use yii\bootstrap4\ActiveForm;

?>
    <h2 style="margin-top: 77px">Вход</h2>
<?php \yii\widgets\Pjax::begin() ?>
<?php $form = ActiveForm::begin([
        'method' => 'post',
        'options' => [
                'data' => ['pjax' => true],
                'class' => 'mt-3',
                'style' => 'width: 30%; min-height: 270px'
        ]
]) ?>
        <?= $form->field($loginForm, 'email',[
            'template' => "{label}\n
                           {input}\n
                           {error}\n
                           ",
            'options' => [
                    'class' => 'mt-3'
            ],
            'inputOptions' => [
                    'placeholder' => 'Введите e-mail',
            ]
])->label('Email *') ?>


<?= $form->field($loginForm, 'password',[
    'template' => "{label}\n
                           {input}\n
                           {error}
                           ",
    'options' => [
        'class' => 'mt-3'
    ],
    'inputOptions' => [
        'placeholder' => 'Введите пароль',
        'type' => 'password'
    ]
])->label('Пароль *') ?>

<?= \yii\helpers\Html::submitButton('Войти', [
        'class' => 'button mt-3'
]) ?>

<?php ActiveForm::end()?>
<?php \yii\widgets\Pjax::end() ?>
