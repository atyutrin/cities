<?php
namespace api\controllers;

use common\models\Country;
use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;
use api\models\LoginForm;
use yii\web\Response;

/**
 * Site controller
 */
class CountryController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator']['authMethods'] = [
            HttpBasicAuth::className(),
            HttpBearerAuth::className()
        ];

        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ]
            ]
        ];

        return $behaviors;
    }

    protected function verbs()
    {
        return [
            'index' => ['get']
        ];
    }

    public function actionIndex()
    {
        return Country::find()->all();
    }


}
