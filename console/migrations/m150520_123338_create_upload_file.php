<?php

use yii\db\Schema;
use yii\db\Migration;

class m150520_123338_create_upload_file extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=MyISAM';
        }

        $this->createTable('{{%upload_file}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_INTEGER . ' NOT NULL',
            'path' => Schema::TYPE_STRING . '(1024) NOT NULL',
            'mime_type' => Schema::TYPE_STRING . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
            'user_id' => Schema::TYPE_INTEGER . ' UNSIGNED NOT NULL',
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%upload_file}}');
    }
}
