<?php
namespace backend\controllers;

use common\models\CourseSearch;
use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\Controller;


class CourseController extends Controller{

//	public $modelClass = "common\models\Course";
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

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex()
    {
        $searchModel = new CourseSearch();
        $dataProvide = $searchModel->search(\Yii::$app->request->getQueryParams());
        return $dataProvide;
    }
}