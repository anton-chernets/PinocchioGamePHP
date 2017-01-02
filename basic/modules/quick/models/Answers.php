<?php

namespace app\modules\quick\models;

use yii;

/**
 * This is the model class for table "answers".
 *
 * @property integer $id
 * @property integer $question_id
 * @property integer $user_id
 * @property string $text
 * @property integer $start_game
 * @property integer $finish_game
 * @property integer $correct_answer_id
 *
 * @property integer $post
 */
class Answers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'default', 'value' => Yii::$app->user->getId()],
            [['question_id', 'user_id', 'text', 'correct_answer_id'], 'required'],
            [['question_id', 'user_id', 'start_game', 'finish_game', 'correct_answer_id'], 'integer'],
            [['text'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'question_id' => Yii::t('app', 'Question ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'text' => Yii::t('app', 'Text'),
            'start_game' => Yii::t('app', 'Start Game'),
            'finish_game' => Yii::t('app', 'Finish Game'),
            'correct_answer_id' => Yii::t('app', 'Correct Answer ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Posts::className(), ['id' => 'question_id']);
    }
}
