<?php

namespace app\models;

use yii;
use \yii\db\ActiveRecord;
use \yii\web\IdentityInterface;
use yii\db\IntegrityException; //ошибку ловим

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $code
 * @property string $login
 * @property string $email
 * @property string $password
 * @property integer $created_at
 * @property integer $confirmed_at
 * @property integer $blocked_at
 * @property integer $deleted_at
 *
 * @property OathToken[] $oathTokens
 */
class User extends ActiveRecord implements IdentityInterface//implements реализовать
{
    public $password_repeat;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'default', 'value'=> time()],//способ 1 (лучший) вписывание времени создания
            [['email', 'created_at', 'code'], 'required'],
            [['created_at', 'confirmed_at', 'blocked_at', 'deleted_at', 'confirmed_at'], 'integer'],
            [['login', 'code'], 'string', 'min' => 4 , 'max' => 32],
            [['email'], 'email'],
            [['password'], 'string', 'min' => 6, 'max' => 64]
            //[['password_repeat'], 'safe']//safe это для бд на validate не нужен а тут будет нужен
        ];
    }

    public function beforeValidate(){ //хеширование пароля
        if($this->isNewRecord){
            //          $this->created_at=time();// способ 2 вписывание времени создания
            $this->password= Yii::$app->security->generatePasswordHash($this->password); //cоль 10 и получаем на выходе хеш сумму пароля
            $this->code = md5(microtime().self::className());
        }
        return parent::beforeValidate();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'email' => 'Email',
            'password' => 'Password',
            'created_at' => 'Created At',
            'confirmed_at' => 'Confirmed At',
            'blocked_at' => 'Blocked At',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOathTokens()
    {
        return $this->hasMany(OathToken::className(), ['user_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getUsername(){
        return $this->login;
    }

    /**
     * @inheritdoc
     */
public function save($runValidation=true, $attributeNames=null){//такяя же есть где то и мы вызовем родительскую и чтоб она возвращала, короче мы ее клоним для отлова ошибки
        $result = false;//по умолчанию будет фалсе но если появится ошибка то будет тру
    try{//обработка ошибки пытаемся словить yii\db\IntegrityException
        $result = parent::save($runValidation, $attributeNames);//почему ошибка пропала?(здесь ошибка), родительская функция save, parent родительская мы ее вызываем она определена ранее была
} catch(IntegrityException $e)//(здесь мы ее отловили и она пропала),сколько ошибок столько и catch
{
    $this->addError('email', 'This email is not correct! duplicate email');
    } return $result;

}
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::find()->where(['login' => $username])->orWhere(['email' => $username])->one();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return true;
    }

    /**
     * @param string $password
     * @param return boolean
     */
    public function validatePassword($password){//проверка пароля ок или не ок, заглушка функцианал попозже, потом функция примет пароль зашифрует и сравнит с хешсуммой в базе если совпали пароль корректный если не т то некорректный
        return Yii::$app->security->validatePassword($password, $this->password);//логика сравнения - валидации
    }
}
