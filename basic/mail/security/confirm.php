<?php

use yii\helpers\Url;

/**
 * @var $user \app\models\User
 */

?>

<div class="site-index">
    <div class="jumbotron">
        <h1>Congratulations <?= $user->login ?>! </h1>

        <p class="lead">You need confirmed email address .</p>

        <p><a class="btn btn-lg btn-success" href="<?= Url::to(['site/confirmation', 'key' => $user->code], true) ?>">Confirm</a></p>
    </div>
</div>
