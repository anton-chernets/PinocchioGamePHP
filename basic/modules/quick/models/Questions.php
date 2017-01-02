<?php

namespace app\modules\quick\models;

use Yii;

/**
 * This is the model class for table "questions".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $text
 * @property integer $category_id
 * @property string $image_url
 * @property integer $priority
 *
 * @property Categories $category
 * @property Images[] $images
 * @property Answers[] $answers
 */
class Questions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'questions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'default', 'value' => Yii::$app->user->getId()],
            [['user_id', 'category_id', 'priority'], 'integer'],
            [['text', 'category_id', 'user_id'], 'required'],
            [['text'], 'string', 'max' => 256],
            [['image_url'], 'string', 'max' => 256],
            [['text', 'priority'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'text' => Yii::t('app', 'Text'),
            'category_id' => Yii::t('app', 'Category ID'),
            'image_url' => Yii::t('app', 'Image Url'),
            'priority' => Yii::t('app', 'Priority'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Images::className(), ['id' => 'image_id'])
            ->viaTable('questions_as_images', ['question_id' => 'id']);//много ко многим через промежуточную таблицу хотя отключена в форме загрузки вопросарадиобаттоном
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answers::className(), ['question_id' => 'id']);
    }
}
