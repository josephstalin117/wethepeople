<?php

use yii\db\Schema;
use yii\db\Migration;

class m150502_130344_create_posts extends Migration
{


    public function safeUp()
    {
        $this->createTable('{{%posts}}', [
            'id' => Schema::TYPE_PK,
            'author' => Schema::TYPE_INTEGER . ' NOT NULL',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'content' => Schema::TYPE_TEXT,
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%posts}}');
    }
}
