<?php

namespace app\modules\game\models;

use Yii;

/**
 * This is the model class for table "game".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $date_start
 * @property integer $date_finish
 * @property integer $ranks
 */
class Game extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'date_start', 'date_finish', 'ranks'], 'integer'],
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
            'date_start' => Yii::t('app', 'Date Start'),
            'date_finish' => Yii::t('app', 'Date Finish'),
            'ranks' => Yii::t('app', 'Ranks'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getQuestions()
    {

    }
}
