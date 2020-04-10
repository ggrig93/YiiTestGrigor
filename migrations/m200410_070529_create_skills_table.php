<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%skills}}`.
 */
class m200410_070529_create_skills_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%skills}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%skills}}');
    }
}
