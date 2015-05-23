<?php

use yii\db\Schema;
use yii\db\Migration;

class m150523_103358_alter_user extends Migration
{
    public function safeUp()
    {
        $this->addColumn('user', 'face', "varchar(255) COMMENT '头像'");
        $this->addColumn('user', 'bio', "varchar(255) COMMENT '自我介绍'");
    }

    public function safeDown()
    {
        $this->dropColumn('user', 'face');
        $this->dropColumn('user', 'bio');
    }
}
