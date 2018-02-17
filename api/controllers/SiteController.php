<?php
namespace api\controllers;

use Yii;
use yii\rest\Controller;
use api\models\LoginForm;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    protected function verbs()
    {
        return [
            'login' => ['post']
        ];
    }

    public function actionIndex()
    {
        return 'api';
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        $model->load(Yii::$app->request->bodyParams, '');
        if ($token = $model->auth()) {
            return [
                'token' => $token->token,
                'expired' => date(DATE_RFC3339, $token->expired_at),
            ];
        } else {
            return $model;
        }
    }
}
