<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Skill extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%skills}}';
    }
    public function behaviors()
    {
        return [TimestampBehavior::className()];
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'unique'],
        ];
    }
    public function getUsers() {
        return $this->hasMany(User::classname(),['user_id' => 'id'])
            ->viaTable('{{%users_skills}}', ['skill','id']);
    }
}
