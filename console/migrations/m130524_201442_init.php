<?php

use yii\db\Schema;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=MyISAM';
        }

        //user
        $this->createTable('{{%user}}', [
            'id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . ' NOT NULL',
            'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
            'password_hash' => Schema::TYPE_STRING . ' NOT NULL',
            'password_reset_token' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING . ' NOT NULL',
            'role' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'realname' => Schema::TYPE_STRING,

            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        //suggestion
        $this->createTable('{{%suggestion}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'content' => Schema::TYPE_TEXT . ' NOT NULL',
            'submitter' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',

            'up' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'down' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'part' => Schema::TYPE_TEXT,

            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER,
        ], $tableOptions);

        $this->createTable('{{%sugges_detail}}', [
            'id' => Schema::TYPE_PK,
            'sugg_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'part_id' => Schema::TYPE_INTEGER,
            'attitude' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
        ], $tableOptions);

        $this->createTable('{{%comment}}', [
            'id' => Schema::TYPE_PK,
            'sugg_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'part_id' => Schema::TYPE_TEXT,
            'content' => Schema::TYPE_TEXT,

            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->createTable('{{%message}}', [
            'id' => Schema::TYPE_PK,
            'send_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'recive_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'un_read' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'content' => Schema::TYPE_TEXT,

            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%suggestion}}');
        $this->dropTable('{{%sugges_detail}}');
        $this->dropTable('{{%comment}}');
        $this->dropTable('{{%message}}');
    }

}
