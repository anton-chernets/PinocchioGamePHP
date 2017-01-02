<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 02.12.16
 * Time: 15:10
 */
use app\models\User;

$this->title = 'All Users';
$this->params['breadcrumbs'][] = $this->title;

$users = User::find()->all();//all users
?>

<div><br><br><? var_dump($users); ?><br><br></div>
