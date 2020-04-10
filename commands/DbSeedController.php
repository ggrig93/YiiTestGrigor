<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\City;
use app\models\Skill;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DbSeedController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex()
    {
       $this->seedCity();
       $this->seedSkill();

        return ExitCode::OK;
    }

    private function seedCity () {
        $data = file_get_contents('web/json/cities.json');
        $data = json_decode($data, true);
        foreach ($data as $item) {
            $model = new City();
            $model->name = $item['city'];
            $model->save();
        }
    }

    private function seedSkill () {
        $data = file_get_contents('web/json/skills.json');
        $data = json_decode($data, true);
        foreach ($data as $item) {
            $model = new Skill();
            $model->name = $item['name'];
            $model->save();
        }
    }
}
