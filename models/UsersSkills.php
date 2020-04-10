<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class UsersSkills extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%users_skills}}';
    }


    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['skill_id'], 'required'],
        ];
    }
}
