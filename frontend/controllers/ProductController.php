<?php

namespace frontend\controllers;

use common\models\Attribute;
use common\models\Category;
use common\models\Image;
use Yii;
use common\models\Product;
use common\models\ProductElastic;
use yii\elasticsearch\ActiveFixture;
use yii\elasticsearch\Command;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use common\models\Video;
use yii\helpers\VarDumper;

class ProductController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            Url::remember();
            return true;
        } else {
            return false;
        }
    }

    public function actionIndex($slug)
    {
        $model = $this->findModel($slug);
        $product = Product::find()->where(['is_published' => '1'])->orderBy('RAND()')->limit(5)->all();

        return $this->render('index', [
            'model' => $model,
            'product' => $product,
        ]);
    }


    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModel($slug)
    {
        if (($model = Product::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



}
