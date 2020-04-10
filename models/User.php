<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%users}}';
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
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    public function getCity() {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    public function getSkills() {
        return $this->hasMany(Skill::className(),['id'=>'skill_id'])
            ->via('usersSkills');
    }

    public function getUsersSkills() {
        return $this->hasMany(UsersSkills::className(),['user_id' => 'id']);
    }

}
