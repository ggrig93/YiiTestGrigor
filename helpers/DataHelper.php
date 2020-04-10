<?php

namespace app\helpers;

use app\models\City;
use app\models\Skill;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class DataHelper
{
    /**
     * @return string
     */
    public static function getRandomUserName()
    {
        $client = new \yii\httpclient\Client();
        $response = $client->get('https://randomuser.me/api/', '', ['dataType' => 'json'])->send();

        if ($response = ArrayHelper::getValue($response->data, 'results.0.name')) {
            return $response['first'] . ' ' . $response['last'];
        }

        return '';
    }


    public static function getCity() {
        return City::find()->select(['id'])
            ->orderBy(new Expression('rand()'))
            ->one();
    }
    public static function getSkills() {
        return Skill::find()->select(['id'])
            ->orderBy(new Expression('rand()'))
            ->limit(rand(3, 10))
            ->all();
    }

}