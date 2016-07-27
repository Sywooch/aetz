<?php

namespace frontend\controllers;

use common\models\Product;
use Yii;
use frontend\models\Search;
use common\models\News;
use common\models\Article;

use yii\helpers\ArrayHelper;

class SearchController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = '';
        $newsList = '';
        $articleList = '';
        $productList = '';
        $queryWithTags = false;

        $model = new Search();

        if ($model->load(Yii::$app->request->get()) ){

            $query = strip_tags($model->query);

            if(strlen($query) < strlen($model->query)) {
                $queryWithTags = true;
                return $this->render('index', [
                    'query' => $query,
                    'model' => $model,
                    'newsList' => $newsList,
                    'articleList' => $articleList,
                    'productList' => $productList,
                    'queryWithTags' => $queryWithTags,
                ]);
            }



            if($query != ''){
                $newsModel = new News();
                $newsList = $newsModel::find()->where(['is_published' => '1'])->andFilterWhere(['like', 'title', $query])->orFilterWhere(['like', 'description', $query])->orFilterWhere(['like', 'description', $query])->all();

                $articleModel = new Article();
                $articleList = $articleModel::find()->where(['is_published' => '1'])->andFilterWhere(['like', 'title', $query])->orFilterWhere(['like', 'description', $query])->all();

                $productModel = new Product();
                $productList = $productModel::find()->where(['is_published' => '1'])->andFilterWhere(['like', 'title', $query])->orFilterWhere(['like', 'description', $query])->all();

                $resulCount = count($newsList)+count($articleList);

                return $this->render('index', [
                    'query' => $query,
                    'model' => $model,
                    'newsList' => $newsList,
                    'articleList' => $articleList,
                    'productList' => $productList,
                    'resulCount' => $resulCount,
                    'queryWithTags' => $queryWithTags,
                ]);
            }
            else {
                return $this->render('index', [
                    'query' => $query,
                    'model' => $model,
                    'newsList' => $newsList,
                    'articleList' => $articleList,
                    'productList' => $productList,
                    'queryWithTags' => $queryWithTags,
                ]);
            }
        }

        else {
            return $this->render('index', [
                'query' => $query,
                'model' => $model,
                'newsList' => $newsList,
                'articleList' => $articleList,
                'productList' => $productList,
                'queryWithTags' => $queryWithTags,
            ]);
        }

    }

}