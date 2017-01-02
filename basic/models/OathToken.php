<?php

namespace app\models;

use \yii\db\ActiveRecord;

/**
 * This is the model class for table "oath_tokens".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $social_id
 * @property string $token
 * @property integer $created_at
 *
 * @property User $user
 */
class OathToken extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oath_tokens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'social_id', 'token', 'created_at'], 'required'],
            [['user_id', 'social_id', 'created_at'], 'integer'],
            [['token'], 'string', 'max' => 256],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'social_id' => 'Social ID',
            'token' => 'Token',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
