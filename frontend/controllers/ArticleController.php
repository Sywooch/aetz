<?php

namespace frontend\controllers;

use common\models\Article;
use common\models\Category;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class ArticleController extends \yii\web\Controller
{
//    public function actionIndex()
//    {
//        $query = Article::find()->where(['is_published' => '1'])->orderBy('created DESC');
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//            'pagination' => [
//                'pageSize' => 6,
//            ],
//        ]);
//
//        return $this->render('index', [
//            'dataProvider' => $dataProvider,
//        ]);
//    }

//    public function actionCategory($id)
//    {
//
//        $query = Article::find()->where(['is_published' => 1, 'category_id' => $id])->orderBy('created DESC');
//
//        $currentCategory = Category::findOne(['is_published' => 1, 'id' => $id]);
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//        ]);
//        return $this->render('category', [
//            'dataProvider' => $dataProvider,
//            'currentCategory' => $currentCategory,
//        ]);
//    }

//    public function actionIndex($slug = '')
//    {
//        $query = Article::find()->where(['is_published' => '1', 'category_id' => '2'])->orderBy('created DESC');
//
//        if($slug){
//            $category = $this->findCategory($slug);
//            $query->andWhere(['category_id' => $category->id]);
//        }
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//            'pagination' => [
//                'pageSize' => 6,
//            ],
//        ]);
//        $categories = Category::find()->where(['model_name' => 'article'])->all();
//
//        return $this->render('index', [
//            'dataProvider' => $dataProvider,
//            'categories' => $categories,
//        ]);
//    }

    public function actionView($slug){

        $model = $this->findArticle($slug);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    protected function findArticle($slug)
    {
        if (($model = Article::find()->where(['slug' => $slug])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findCategory($slug)
    {
        if (($model = Category::find()->where(['slug' => $slug])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }}
