<?php

namespace backend\controllers;

use common\models\Image;
use Yii;
use common\models\News;
use common\models\search\NewsSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use vova07\fileapi\actions\UploadAction as FileAPIUpload;


class NewsController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate($image_tab = false)
    {
        $model = new News();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->saveImages();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'image_tab' => $image_tab
            ]);
        }
    }

    public function actionUpdate($id, $image_tab = false)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->saveImages();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'image_tab' => $image_tab
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
        if (($model = News::findOne($id)) !== null) {
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

    public function actionUpdateImageTitle($image_id) {

        $imageModel = Image::findOne($image_id);
        $news_id = News::findOne($imageModel->item_id)->id;

        if ($imageModel->load(Yii::$app->request->post()) && $imageModel->save() ) {
            return $this->redirect(['update',
                'id' => $news_id,
                'image_tab' => true
            ]);
        } else {
            return $this->renderAjax('_imageUpdate', [
                'imageModel' => $imageModel,
                'news_id' => $news_id,
            ]);
        }
    }

    public function actionImageDelete($id){
        $imageModel = Image::findOne($id);

        $newsId = $imageModel->item_id;

        $imageModel->delete();
        return $this->redirect(['update',
            'id' => $newsId,
            'image_tab' => true
        ]);
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
