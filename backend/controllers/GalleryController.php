<?php

namespace backend\controllers;

use common\models\Gallery;
use common\models\Image;
use common\models\search\GallerySearch;
use Yii;
use common\models\Article;
use common\models\search\ArticleSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use vova07\fileapi\actions\UploadAction as FileAPIUpload;


class GalleryController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new GallerySearch();
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
        $model = new Gallery();

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
        if (($model = Gallery::findOne($id)) !== null) {
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
        $item_id = Gallery::findOne($imageModel->item_id)->id;

        if ($imageModel->load(Yii::$app->request->post()) && $imageModel->save() ) {
            return $this->redirect(['update',
                'id' => $item_id,
                'image_tab' => true
            ]);
        } else {
            return $this->renderAjax('_imageUpdate', [
                'imageModel' => $imageModel,
                'news_id' => $item_id,
            ]);
        }
    }

    public function actionImageDelete($id){
        $imageModel = Image::findOne($id);

        $itemId = $imageModel->item_id;

        $imageModel->delete();
        return $this->redirect(['update',
            'id' => $itemId,
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
