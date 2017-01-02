<?php

namespace app\modules\quick\models\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\quick\models\Answers;

/**
 * AnswersSearch represents the model behind the search form about `app\modules\quick\models\Answers`.
 */
class AnswersSearch extends Answers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'question_id', 'user_id', 'start_game', 'finish_game', 'correct_answer_id'], 'integer'],
            [['text'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Answers::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'question_id' => $this->question_id,
            'user_id' => $this->user_id,
            'start_game' => $this->start_game,
            'finish_game' => $this->finish_game,
            'correct_answer_id' => $this->correct_answer_id,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
