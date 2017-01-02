<?php

    use yii\db\Migration;

class m161126_173249_basic_quick_game_struct extends Migration
{
    public $categories = 'categories';

    public $questions = 'questions';

    public $answers = 'answers';

    public $images = 'images';

    public $questions_as_images = 'questions_as_images';

//    public $categories_as_questions = 'categories_as_questions';
//
//    public $questions_as_answers = 'questions_as_answers';

    public function up()
    {
        $this->createTable($this->categories, [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->unique()->notNull(),
            'code' => $this->string(32),
            'parent_id' => $this->integer(),
            'description' => $this->string(),
            'image_url' => $this->string(),
            'sort_index' => $this->integer()->unique()
        ]);

        $this->createTable($this->questions, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'text' => $this->string()->unique()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'image_url' => $this->string(256),
            'priority' => $this->integer()->unique()
        ]);

        $this->createTable($this->answers, [
            'id' => $this->primaryKey(),
            'question_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'text' => $this->string()->notNull(),
            'start_game' => $this->integer(),
            'finish_game' => $this->integer(),
            'correct_answer_id' => $this->boolean()->notNull()
        ]);

        $this->createTable($this->images, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'code' => $this->string(256),
            'name' => $this->string(256),
            'url' => $this->string(256),
            'extension' => $this->string(16),
            'size' => $this->integer(),
        ]);

        $this->createTable($this->questions_as_images, [
            'id' => $this->primaryKey(),
            'image_id' => $this->integer(),
            'question_id' => $this->integer()
        ]);

//        Schema::table('question', function ($table) {
//            $table->integer('category_id')->unsigned();
//
//            $table->foreign('category_id')->references('id')->on('categories');
//        });

//        $this->createTable($this->questions_as_answers, [
//            'id' => $this->primaryKey(),
//            'answer_id' => $this->integer(),
//            'question_id' => $this->integer()
//        ]);
//
//        $this->createTable($this->categories_as_questions, [
//            'id' => $this->primaryKey(),
//            'category_id' => $this->integer(),
//            'question_id' => $this->integer()
//        ]);

        $this->addForeignKey('FK_'.$this->questions.'_'.$this->categories, $this->questions, 'category_id', $this->categories, 'id');
//        $this->addForeignKey('FK_'.$this->questions_table.'_'.$this->answers_table, $this->questions_table, 'id', $this->answers_table, 'question_id');

        return true;
    }

    public function down()
    {
        $this->dropTable($this->categories);
        $this->dropTable($this->questions);
        $this->dropTable($this->answers);
        $this->dropTable($this->images);
        $this->dropTable($this->questions_as_images);
//        $this->dropForeign('question_category_id_foreign');
        $this->dropTable('FK_'.$this->questions.'_'.$this->categories, $this->questions, 'category_id', $this->categories, 'id');
//        $this->dropTable($this->categories_as_questions);
//        $this->dropTable($this->questions_as_answers);

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
