<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
* @property integer $id
* @property string $name
* @property  User[] $users
 */

class City extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%cities}}';
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
        return $this->hasMany(User::className(), ['city_id' => 'id']);
    }
}
