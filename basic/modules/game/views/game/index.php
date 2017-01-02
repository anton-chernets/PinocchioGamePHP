<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Let\'s Go');
?>
<div class="game-over" style="text-align: center;">

    <h1 style="display: inline-block;"><?= Html::encode($this->title) ?></h1>
    <br>
    <img id="pinokio" src="/images/pinokio/pingame/main.jpg" alt="Let's Go">
</div>

<script type="text/JavaScript">
    function doRedirect() {
        atTime = "3000";
        toUrl = "start";

        setTimeout("location.href = toUrl;", atTime);
    }
</script>

<body onload="doRedirect();">