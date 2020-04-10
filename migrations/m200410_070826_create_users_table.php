<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%cities}}`
 */
class m200410_070826_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'city_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `city_id`
        $this->createIndex(
            '{{%idx-users-city_id}}',
            '{{%users}}',
            'city_id'
        );

        // add foreign key for table `{{%cities}}`
        $this->addForeignKey(
            '{{%fk-users-city_id}}',
            '{{%users}}',
            'city_id',
            '{{%cities}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%cities}}`
        $this->dropForeignKey(
            '{{%fk-users-city_id}}',
            '{{%users}}'
        );

        // drops index for column `city_id`
        $this->dropIndex(
            '{{%idx-users-city_id}}',
            '{{%users}}'
        );

        $this->dropTable('{{%users}}');
    }
}
