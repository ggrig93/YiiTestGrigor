<?php

namespace app\controllers;

use app\helpers\DataHelper;
use app\models\City;
use app\models\Skill;
use app\models\User;
use app\models\UserSkills;
use http\Client;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create-user', 'index', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'create-user' => ['post'],
                    'delete' => ['post'],
                    'get-data' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGetData() {
        $data = [];
        foreach (User::find()->batch(100) as $users) {
            foreach ($users as $user) {
                $data[] = [
                    $user->id, $user->name,
                    $user->city->name,
                    implode(', ', \yii\helpers\ArrayHelper::map($user->skills, 'id', 'name'))
                ];
            }
        }

        return json_encode(compact('data'));
    }

    public function actionCreateUser() {

        $user = new User();
        $user->name = DataHelper::getRandomUserName();
        $user->city_id =  DataHelper::getCity()->id;
        if($user->save()) {
            foreach (DataHelper::getSkills() as $skill) {
                $user->link('skills', $skill);
            }
        }
    }

    public function actionDelete() {
        $id = \Yii::$app->request->post('id');
        $model = User::find(['id' => $id])->one();
        $model->unlinkAll('usersSkills', true);
        $model->delete();
        return $this->redirect(['index']);
    }

}
