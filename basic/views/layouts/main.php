<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\FontAsset;
use app\models\User;
use app\widgets\WLang;

rmrevin\yii\fontawesome\AssetBundle::register($this);
AppAsset::register($this);
FontAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="loader">
    <div class="loader_inner"></div>
</div>

<div class="wrap">
<br>
<br>
<br>
    <?= WLang::widget();?>

    <?php
    NavBar::begin([
        'brandLabel' => 'p- game',//'brandLabel' => '<img src="favicon-32x32.png" class="pull-left"/>Car Management System',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $userId = Yii::$app->user->id;
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],

            Yii::$app->user->isGuest ? ('') : (
            ['label' => 'Account(' . Yii::$app->user->identity->username . ')', 'url' => ['/user/cabinet']]
            ),
            $userId=='1' ? (
            ['label' => 'Сontrol', 'options' => ['id' => 'down_admin'], 'items'=>[
                ['label' => 'Users', 'url' => ['/admin/menu/'],'options' => ['id' => 'wn_admin'] ],
                ['label' => 'Category', 'url' => ['/quick/categories/'],'options' => ['id' => 'wn_admin']],
                ['label' => 'Question', 'url' => ['/quick/questions/'],'options' => ['id' => 'wn_admin']],
                ['label' => 'Answers', 'url' => ['/quick/answers/'],'options' => ['id' => 'wn_admin']],
                ['label' => 'Images', 'url' => ['/quick/images/'],'options' => ['id' => 'wn_admin']]
            ] ]
            ) : (''),
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
            ['label' => 'Register', 'url' => ['/site/register']]
            ) : (''),
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?php if (Yii::$app->session->hasFlash('error') ): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo Yii::$app->session->getFlash('error'); ?>
            </div>
        <?php endif; ?>

        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div style="text-align: center;" class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <p id="f" style="display: inline-block;" class="left">&copy; Anton Chernets <?= date('Y') ?>:</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

        <div class="social_wrap">
            <p class="pull-right"><ul>
                <li><a href="https://twitter.com/Anton_Koka" target="_blank"><i class="fa fa-twitter"></i></a></li>
                <li><a href="http://vk.com/antonuse" target="_blank"><i class="fa fa-vk"></i></a></li>
                <li><a href="https://www.facebook.com/antonusers" target="_blank"><i class="fa fa-facebook"></i></a></li>
                <li><a href="https://www.instagram.com/anton.chernets/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                <li><a href="https://www.linkedin.com/in/AntonChernets" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="https://github.com/anton-chernets/" target="_blank"><i class="fa fa-github"></i></a></li>
            </ul>
            </p>
        </div>

            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
