<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $skill_id
 */
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
