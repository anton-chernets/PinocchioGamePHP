<?php

use yii\db\Migration;

class m161028_155848_basic_user_table_struct extends Migration
{
    public $user_table = 'users';

    public $token_table = 'oath_tokens';

    public function safeUp()
    {
        $this->createTable($this->user_table, [
            'id' => $this->primaryKey(),
            'code' => $this->string(32)->unique()->notNull(),
            'login' => $this->string(32),
            'email' => $this->string(128),
            'password' => $this->string(64),
            'created_at' => $this->integer()->notNull(),
            'confirmed_at' => $this->integer(),
            'blocked_at' => $this->integer(),
            'deleted_at' => $this->integer()
        ]);

        $this->createTable($this->token_table, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'social_id' => $this->integer()->notNull(),
            'token' => $this->string(256)->notNull(),
            'created_at' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('FK_'.$this->token_table.'_'.$this->user_table, $this->token_table, 'user_id', $this->user_table, 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_'.$this->token_table.'_'.$this->user_table, $this->token_table);
        $this->dropTable($this->user_table);
        $this->dropTable($this->token_table);
    }
}
