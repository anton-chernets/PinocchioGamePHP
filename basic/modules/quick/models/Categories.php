<?php

namespace app\modules\quick\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $parent_id
 * @property string $description
 * @property string $image_url
 * @property integer $sort_index
 *
 * @property Questions[] $questions
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id', 'sort_index'], 'integer'],
            [['name', 'code'], 'string', 'max' => 32],
            [['description', 'image_url'], 'string', 'max' => 255],
            [['name', 'sort_index'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'code' => Yii::t('app', 'Code'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'description' => Yii::t('app', 'Description'),
            'image_url' => Yii::t('app', 'Image Url'),
            'sort_index' => Yii::t('app', 'Sort Index'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Questions::className(), ['category_id' => 'id']);
    }
}
