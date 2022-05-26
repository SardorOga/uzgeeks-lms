<?php

namespace backend\controllers;

use common\models\UserCourseSearch;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

class UserCourseController extends \yii\rest\Controller
{
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::class,
            'authMethods' => [
                HttpBasicAuth::class,
                HttpBearerAuth::class,
                QueryParamAuth::class,
            ],
        ];
        return $behaviors;
    }


    public function actionIndex()
    {
        $searchModel = new UserCourseSearch();
        $searchModel->user_id = \Yii::$app->user->identity->id;
        $dataProvider = $searchModel->search(\Yii::$app->request->getQueryParams());
        return $dataProvider;
    }
}