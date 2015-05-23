<?php

use yii\db\Schema;
use yii\db\Migration;

class m150523_120527_alter_upload_file extends Migration
{

    public function safeUp()
    {
        $this->dropColumn('upload_file','name');
    }

    public function safeDown()
    {
        $this->addColumn('upload_file','name','varchar(255) not null');
    }
}
