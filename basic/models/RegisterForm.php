<?php

namespace app\models;

use yii;
use yii\base\Model;

/**
 * RegisterForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 * @property string $username
 * @property string $password
 * @property string $password_conf
 * @property string $email
 * @property string $email_conf
 * @property string $captcha
 */
class RegisterForm extends Model
{
    public $username;

    public $email;

    public $email_conf;

    public $password;

    public $captcha;

    public $password_conf;

    // public $rememberMe = true; //куки не нужен
    // $_user; // ненадо


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'email', 'password_conf', 'email_conf', 'captcha'], 'required'],
            [['username'], 'string', 'min' => 4, 'max' => 32],
            [['email', 'email_conf'], 'email'],
            ['email_conf', 'compare', 'compareAttribute'=>'email', 'message' => 'Email do not match'],
            [['password', 'password_conf'], 'string', 'min' => 6, 'max' => 64],
            ['password_conf', 'compare', 'compareAttribute'=>'password', 'message' => 'Passwords do not match'],
            ['captcha', 'captcha'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Login',
            'password' => 'Password',
            'password_conf' => 'Confirmation Password',
            'email' => 'E-mail',
            'email_conf' => 'Confirmation E-mail',
            'captcha' => 'You are Robots?',
        ];
    }

    /**
     * @return boolean
     */
    public function append()
    {
        if($this->validate()) {
            $user = new User();
            $user->load($this->toArray(), '');
            $user->login = $this->username;

            if(!$user->save()){
                Yii::$app->session->setFlash('error', "Can't create user on time");
                return false;
            }else {
                Yii::$app->mailer->compose('security/confirm', ['user' => $user])
                    ->setTo($this->email)
                    ->setFrom([Yii::$app->params['adminEmail'] => 'My test project'])
                    ->setSubject('Confirmation')
                    ->send();
            }
            //var_dump($user);
            return true;
        }
        return false;
    }
//Yii::$app->session->setFlash('error', json_encode($user->getErrors())); //вывод ошибки жестко
}
