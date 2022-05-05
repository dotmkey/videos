<?php

use yii\db\Migration;

class m220503_124343_create_file_table extends Migration
{
    use \app\src\infrastructure\migration\TypesTrait;

    public function safeUp()
    {
        $this->createTable('file', [
            'id' => $this->bigPrimaryKey(),
            'url' => $this->text(),
            'path' => $this->text()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%file}}');
    }
}
