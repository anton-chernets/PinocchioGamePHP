<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 22.11.16
 * Time: 23:18
 */

namespace app\controllers;

use yii;
use app\models\Admin;
use app\models\Category;
use \yii\web\Controller;

class AdminController extends Controller

{
    /**
     * Displays admin page.
     *
     * @return string
     */
    public function actionMenu()
    {
        return $this->render('menu');
    }

    /**
     * Displays blocking users page.
     *
     * @return string
     */
    public function actionBlocking()
    {
        return $this->render('blocking');
    }

    /**
     * Displays delete users page.
     *
     * @return string
     */
    public function actionDelete()
    {
        return $this->render('delete');
    }

    public function actionUsers()
    {
        return $this->render('users');
    }
}
