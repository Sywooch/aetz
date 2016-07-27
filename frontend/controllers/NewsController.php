<?php

namespace frontend\controllers;

use common\models\Image;
use common\models\News;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class NewsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $newsQuery = News::find()->where(['is_published' => '1'])->orderBy('created DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $newsQuery,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($slug){

        $model = $this->findNews($slug);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    protected function findNews($slug)
    {
        if (($model = News::find()->where(['slug' => $slug])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}