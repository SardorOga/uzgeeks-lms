<?php

namespace backend\controllers;

use backend\models\SignupForm;

class RegisterController extends \yii\rest\Controller
{
    public function actionIndex()
    {
        $model = new SignupForm();
        if ($model->load(\Yii::$app->request->post(),'') && $model->signup()) {
            return ['success'=>true];
        }else{
            return ['success'=>false, 'error'=>$model->getFirstErrors()];
        }
    }
}