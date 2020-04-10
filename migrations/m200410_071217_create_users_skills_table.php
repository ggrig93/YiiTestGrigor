<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users_skills}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%users}}`
 * - `{{%skills}}`
 */
class m200410_071217_create_users_skills_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users_skills}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'skill_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-users_skills-user_id}}',
            '{{%users_skills}}',
            'user_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-users_skills-user_id}}',
            '{{%users_skills}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        // creates index for column `skill_id`
        $this->createIndex(
            '{{%idx-users_skills-skill_id}}',
            '{{%users_skills}}',
            'skill_id'
        );

        // add foreign key for table `{{%skills}}`
        $this->addForeignKey(
            '{{%fk-users_skills-skill_id}}',
            '{{%users_skills}}',
            'skill_id',
            '{{%skills}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-users_skills-user_id}}',
            '{{%users_skills}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-users_skills-user_id}}',
            '{{%users_skills}}'
        );

        // drops foreign key for table `{{%skills}}`
        $this->dropForeignKey(
            '{{%fk-users_skills-skill_id}}',
            '{{%users_skills}}'
        );

        // drops index for column `skill_id`
        $this->dropIndex(
            '{{%idx-users_skills-skill_id}}',
            '{{%users_skills}}'
        );

        $this->dropTable('{{%users_skills}}');
    }
}
