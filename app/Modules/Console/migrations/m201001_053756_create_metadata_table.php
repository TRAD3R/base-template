<?php

use yii\db\Migration;

class m201001_053756_createmetadata_table extends Migration
{
    public function safeUp()
    {
        $this->renameTable('{{%setting_page}}', '{{%meta_data}}');
        $this->createTable('{{%meta_data}}', [
            'action_id' => $this->primaryKey(),
            'title' => $this->string(255),
            'meta_description' => $this->string(255)
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%meta_data}}');
    }
}