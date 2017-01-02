<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;

//для отображения текущего файла __FILE__
?>
<div class="site-about">

    <h1><?= Html::encode($this->title)." Pinocchio project" ?></h1>

    <p class="about_text">
        <strong>Original Pinocchio mult 1940 years:</strong>
    </p>
        <br>
    <div class="myvideo">
        <iframe width="560" height="315" src="//www.youtube.com/embed/VvJyXgF9hlo" frameborder="0" allowfullscreen></iframe>
    </div>




</div>
