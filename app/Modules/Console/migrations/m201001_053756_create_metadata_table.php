<?php

use yii\db\Migration;

class m201001_053756_create_metadata_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%meta_data}}', [
            'action' => $this->primaryKey(),
            'title' => $this->string(255),
            'meta_description' => $this->string(255)
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%meta_data}}');
    }
}