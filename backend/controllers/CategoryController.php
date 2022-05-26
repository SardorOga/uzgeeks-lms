<?php
namespace backend\controllers;

// use yii\rest\ActiveController;

// class CategoryController extends ActiveController{
// 	public $modelClass = "common\models\Category";
// }

use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use common\models\Category;

class CategoryController extends ActiveController{
	public $modelClass = 'common\models\Category';
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
	public function actionIndex(){
		$provider = new ActiveDataProvider([
			'query'=>Category::find(),
			'pagination'=>[
				'pageSize'=>3
			]
		]);

		return $provider;
	}
}
