<?php

use yii\db\Migration;

/**
 * Class m200410_120727_create_seed_command
 */
class m200410_120727_create_seed_command extends Migration
{

    public function up()
    {
        Yii::$app->runAction('db-seed');
    }
}
