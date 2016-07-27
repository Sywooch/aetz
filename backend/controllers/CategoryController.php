<?php

namespace backend\controllers;

use common\models\Image;
use common\models\search\CategorySearch;
use Yii;
use common\models\Category;
use common\models\search\ExampleSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use vova07\fileapi\actions\UploadAction as FileAPIUpload;


class CategoryController extends Controller
{

    public function actionIndex($model_name)
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $model_name);

        return $this->render('index', [
            'model_name' => $model_name,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id, $model_name)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'model_name' => $model_name,
        ]);
    }

    public function actionCreate($model_name)
    {
        $model = new Category();
        $categories = Category::find()->where(['model_name' => $model_name])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'model_name' => $model_name]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'model_name' => $model_name,
                'categories' => $categories
            ]);
        }
    }

    public function actionUpdate($id, $model_name)
    {
        $model = $this->findModel($id);
        $categories = Category::find()->where(['model_name' => $model_name])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'model_name' => $model_name]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'model_name' => $model_name,
                'categories' => $categories
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actions()
    {
        return [
            'fileapi-upload' => [
                'class' => FileAPIUpload::className(),
                'path' => '@frontend/web/images/',
                'unique' => true,
            ]
        ];
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

}
