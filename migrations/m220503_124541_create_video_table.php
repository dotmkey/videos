<?php

use yii\db\Migration;

class m220503_124541_create_video_table extends Migration
{
    use \app\src\infrastructure\migration\TypesTrait;

    public function safeUp()
    {
        $this->createTable('video', [
            'id' => $this->bigPrimaryKey(),
            'title' => $this->text(),
            'thumbnail_id' => $this->bigInteger()->null(),
            'duration' => $this->integer(),
            'views' => $this->integer(),
            'added_at' => $this->dateTime()
        ]);
        $this->addForeignKey('fk_video_thumbnail_id', 'video', 'thumbnail_id', 'file', 'id', 'SET NULL', 'CASCADE');
        $this->createIndex('video_added_at_id_idx', 'video', ['added_at', 'id']);
        $this->createIndex('video_views_id_idx', 'video', ['views', 'id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%video}}');
    }
}
