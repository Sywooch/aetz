<?php

namespace frontend\controllers;

use common\models\Gallery;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class GalleryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = Gallery::find()->where(['is_published' => '1'])->orderBy('created DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 6,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($slug){

        $model = $this->findArticle($slug);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    protected function findArticle($slug)
    {
        if (($model = Gallery::find()->where(['slug' => $slug])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}