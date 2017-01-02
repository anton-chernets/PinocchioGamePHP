<?php

namespace app\modules\game\models;

use Yii;

/**
 * This is the model class for table "game_as_questions".
 *
 * @property integer $id
 * @property integer $game_id
 * @property integer $questions_id
 * @property integer $answer_id
 */
class GameAsQuestions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_as_questions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_id', 'questions_id', 'answer_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'game_id' => Yii::t('app', 'Game ID'),
            'questions_id' => Yii::t('app', 'Questions ID'),
            'answer_id' => Yii::t('app', 'Answer ID'),
        ];
    }
}
