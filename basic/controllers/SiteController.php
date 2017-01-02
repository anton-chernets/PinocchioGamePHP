<?php

namespace app\controllers;

use app\models\ChangeForm;
use app\models\User;
use yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegisterForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionConfirmation($key){
        $user = User::findOne(['code' => $key]);

        if($user) {
            $user->confirmed_at = time();
            $user->save();
            Yii::$app->user->login($user);
        }
        else
            {
                echo 'No user';
            }
        Yii::$app->response->redirect(Yii::$app->getHomeUrl());
        //var_dump($user);

        //var_dump($key);
        //die();//можно без скобочек
    }


    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        //жесткая регистрация
//        $user = new User([
//            'id'=>'1',
//        'login'=>'admin',
//        'email'=>'loginuse@mail.ru',
//        'password'=>'Koksohim89',
//        'created_at'=>time(),
//        'confirmed_at'=>time()
//        ]);
//        $user->save();
//        var_dump("<br><br><br><br><br><br>");
//        var_dump($user->getErrors());//список ошибок
        //жесткая регистрация

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Register action.
     *
     * @return string
     */
    public function actionRegister()
    {
        //нормальная регистрация
        $form = new RegisterForm();

        if($form->load(Yii::$app->request->post()) && $form->append())
        {
            return $this->redirect(['login']);
        }

        return $this->render('register',[
            'model' => $form
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


}
