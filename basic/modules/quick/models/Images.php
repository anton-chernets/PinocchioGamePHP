<?php

namespace app\modules\quick\models;

use yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "images".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $code
 * @property string $name
 * @property string $url
 * @property string $extension
 * @property integer $size
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'default', 'value' => Yii::$app->user->getId()],
            [['user_id'], 'required'],
            [['user_id', 'size'], 'integer'],
            [['code', 'name', 'url'], 'string', 'max' => 256],
            [['code'], 'unique', 'targetClass' => self::className(), 'targetAttribute' => 'code'],
            [['extension'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'url' => Yii::t('app', 'Url'),
            'extension' => Yii::t('app', 'Extension'),
            'size' => Yii::t('app', 'Size'),
        ];
    }
}
