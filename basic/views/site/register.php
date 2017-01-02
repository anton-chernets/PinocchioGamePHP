<?php

//надо здесь все переменные, с которыми работаем, прописать
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\RegisterForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\authclient\widgets\AuthChoice;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">

        <div class="col-xs-12">
            <div class="socialin"><span>Sign in:</span></div>

            <?php $authAuthChoice = AuthChoice::begin([
                'baseAuthUrl' => ['verify/auth']
            ]); ?>
            <ul>
                <?php foreach ($authAuthChoice->getClients() as $client): ?>
                    <li><?= $authAuthChoice->clientLink($client) ?></li>
                <?php endforeach; ?>
            </ul>
            <?php AuthChoice::end(); ?>
        </div>
    </div>

    <?php $form = ActiveForm::begin([
        'id' => 'register-form',
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'password_conf')->passwordInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'email_conf')->textInput() ?>

    <?= $form->field($model, 'captcha')->widget(Captcha::className(), [
        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
    ]) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
