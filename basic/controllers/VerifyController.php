<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\OathToken;
use app\models\User;
use app\components\Randomizer;
use yii\authclient\clients\Facebook;
use yii\authclient\clients\VKontakte;

class VerifyController extends Controller
{

    public function actions()//для многих страниц можно использовать singl action
    {
        return [
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
            ],
        ];
    }

    /**
     * @param \yii\authclient\clients\Facebook $client
     * @param \yii\authclient\clients\VKontakte $client
     */
    public function successCallback($client)
    {// настройка выше. когда работает событие то оно вызывает эту функцию а она передаст объект клиента

//        if($client instanceof Facebook){
//
//        } if($client instanceof VKontakte){
//
//    } else{
//
//    }

        $attributes = $client->getUserAttributes();

        $token = OathToken::findOne(['token' => $attributes['id']]);// надо добавить ид соцсети чтоб не было повтора токинов

        if($token){
            Yii::$app->user->login($token->user);
        } else{

            $email = empty($attributes['email']) ? Randomizer::emailRandom() : $attributes['email'];

            $user = new User([
                'email' => $email,
                'login' => $attributes['screen_name'],
                'confirmed_at' => time()
            ]);
            $user->save();

            $token = new OathToken([
                'user_id' => $user->id,
                'social_id' => intval($client->clientId),
                'token' => (string)$attributes['id'],
                'created_at' => time(),
            ]);
            $token->save();

            Yii::$app->user->login($user);
        }

//        $this->createTable($this->user_table, [
//            'id' => $this->primaryKey(),
//            'code' => $this->string(32)->unique()->notNull(),
//            'login' => $this->string(32),
//            'email' => $this->string(128),
//            'password' => $this->string(64),
//            'created_at' => $this->integer()->notNull(),
//            'confirmed_at' => $this->integer(),
//            'blocked_at' => $this->integer(),
//            'deleted_at' => $this->integer()
//        ]);
//        $this->createTable($this->token_table, [
//            'id' => $this->primaryKey(),
//            'user_id' => $this->integer()->notNull(),
//            'social_id' => $this->integer()->notNull(),
//            'token' => $this->string(256)->notNull(),
//            'created_at' => $this->integer()->notNull()

        // Вместо debug
//          file_put_contents('/opt/lampp/htdocs/pinokio/basic/responce.json', json_encode($attributes));// данные с соцсети сливаются в json
//          var_dump($attributes);

    }

}