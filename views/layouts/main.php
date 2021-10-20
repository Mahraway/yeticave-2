<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="../css/normalize.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet">

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="page-wrapper">

    <header class="main-header">
        <div class="main-header__container container">
            <h1 class="visually-hidden">YetiCave</h1>
            <a class="main-header__logo" href="<?= \yii\helpers\Url::home() ?>">
                <img src="../img/logo.svg" width="160" height="39" alt="Логотип компании YetiCave">
            </a>

            <?= $this->render('_search') ?>

            <nav class="user-menu">
                <?php if (Yii::$app->user->isGuest): ?>
                    <ul class="user-menu__list">
                        <li class="user-menu__item">
                            <a href="<?= Url::to(['signup']) ?>">Регистрация</a>
                        </li>
                        <li class="user-menu__item">
                            <a href="<?= Url::to(['login']) ?>">Вход</a>
                        </li>
                    </ul>
                <?php else: ?>
                    <div class="user-menu__logged">
                    <a class="profile" href="<?= Url::to(['#']) ?>">
                        <?= \Yii::$app->user->identity->name ?>
                    </a>
                    <ul class="user-menu__list">
                        <li class="user-menu__item">
                            <a href="<?= Url::to(['lots/create']) ?>">Добавить</a>
                        </li>
                        <li class="user-menu__item">
                            <a href="<?= Url::to(['logout']) ?>">Выход</a>
                        </li>
                    </ul>
                    </div>
                <?php endif; ?>
            </nav>
        </div>
        <?php if (\Yii::$app->controller->id . \Yii::$app->controller->action->id != 'mainindex'): ?>
            <?= $this->render('_menu'); ?>
        <?php endif; ?>
    </header>
</div>
<main class="container">
    <?= $content ?>
</main>

<footer class="main-footer">
    <?= $this->render('footer') ?>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
