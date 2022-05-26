<?php

namespace backend\controllers;

use yii\rest\Controller;
use common\models\User;
use common\models\LoginForm;
use yii\web\UnauthorizedHttpException;

class AuthController extends Controller
{
    public function actionIndex()
    {
        $token = \Yii::$app->security->generateRandomString();
        return [
            'access_token' => $token
        ];
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post(),'') && ($token = $model->login())){
            return ['access_token' => $token];
        }
        else throw new UnauthorizedHttpException();

    }
}