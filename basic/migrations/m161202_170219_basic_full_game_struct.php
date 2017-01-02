<?php

use yii\db\Migration;

class m161202_170219_basic_full_game_struct extends Migration
{
    public $game = 'game';

    public $game_as_questions = 'game_as_questions';

    public function up()
    {

        $this->createTable($this->game, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'date_start' => $this->integer(),
            'date_finish' => $this->integer(),
            'ranks' => $this->integer()
        ]);

        $this->createTable($this->game_as_questions, [
            'id' => $this->primaryKey(),
            'game_id' => $this->integer(),
            'questions_id' => $this->integer(),
            'answer_id' => $this->integer()
        ]);

        return true;

    }

    public function down()
    {
        $this->dropTable($this->game);
        $this->dropTable($this->game_as_questions);

        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
