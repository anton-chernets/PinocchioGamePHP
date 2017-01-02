<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 23.11.16
 * Time: 21:16
 */

/* @var $this yii\web\View */

$this->title = 'Admin';
$this->params['breadcrumbs'][] = $this->title;


echo '<br><br><a href="users">All users</a><br><br>';
echo '<br><br><a href="blocking">Blocking users</a><br><br>';
echo '<br><br><a href="delete">Delete users</a><br><br>';