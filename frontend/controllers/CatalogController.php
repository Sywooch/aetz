<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Product;
use common\models\ProductElastic;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\data\Sort;
use common\models\search\ProductFilterSearch;
use common\models\ProductAttribute;
use common\models\Attribute;
use frontend\models\Filter;
use frontend\models\Search;
use Yii;
use common\models\search\ProductSearch;
use yii\web\NotFoundHttpException;

class CatalogController extends \yii\web\Controller {

    public function beforeAction($action) {
        if (parent::beforeAction($action)) {
            Url::remember();
            return true;
        } else {
            return false;
        }
    }

    public function actionTest() {

        return $this->render('test');
    }

    public function actionTest2() {

        return $this->render('test2');
    }

    public function actionSearch() {

        $searchModel = new Search();

        $productModel = new Product();

        $query = $productModel::find()->where(['is_published' => '1'])->limit(30)->orderBy('created DESC');

        if ($searchModel->load(Yii::$app->request->get()) ){

            $keyword = strip_tags($searchModel->query);
            $query = $productModel::find()->where(['is_published' => '1'])->andFilterWhere(['like', 'title', $keyword])->orFilterWhere(['like', 'description', $keyword]);

        }

        $productDataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('search', [
            'productDataProvider' => $productDataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionView() {
        return $this->render('view');
    }

    /**
     * @param Category[] $categories
     * @param int $activeId
     * @param int $parent
     * @return array
     */
    private function getMenuItems($categories, $activeId = null, $parent = null) {
        $menuItems = [];
        foreach ($categories as $category) {
            if ($category->parent_id === $parent) {
                $menuItems[$category->id] = [
                    'active' => $activeId === $category->id,
                    'label' => $category->title,
                    'url' => ['catalog/list', 'id' => $category->id],
                    'items' => $this->getMenuItems($categories, $activeId, $category->id),
                ];
            }
        }
        return $menuItems;
    }

    /**
     * Returns IDs of category and all its sub-categories
     *
     * @param Category[] $categories all categories
     * @param int $categoryId id of category to start search with
     * @param array $categoryIds
     * @return array $categoryIds
     */
    private function getCategoryIds($categories, $id, &$ids = []) {
        foreach ($categories as $category) {
            if ($category->id == $id) {
                $ids[] = $category->id;
            } elseif ($category->parent_id == $id) {
                $this->getCategoryIds($categories, $category->id, $ids);
            }
        }
        return $ids;
    }




    public function actionList($id = 1) {

        /** @var Category $category */
        $category = null;

        $searchModel = new ProductFilterSearch();
        if($id){
            if(!$searchModel->category_id){
                $searchModel->category_id = $id;
            }
        }
        $searchModel->load(Yii::$app->request->queryParams);

        $category = Category::find()->where('`id` = :id',[':id'=>$searchModel->category_id])->one();

        $productAttributeModel = [];
        foreach ($category->customAttributes as $productAttribute) {
            if ($productAttribute->type_id == Attribute::TYPE_TEXT) {
                $productAttributeModel[$productAttribute->id . '_from'] = new ProductAttribute();
                $productAttributeModel[$productAttribute->id . '_to'] = new ProductAttribute();
            } else {
                $productAttributeModel[$productAttribute->id] = new ProductAttribute();
            }
        }

        $sort = new Sort([
            'attributes' => [
                'price' => [
                    'asc' => ['price' => SORT_ASC,],
                    'desc' => ['price' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'Цена',
                ],
                'name' => [
                    'asc' => ['title' => SORT_ASC,],
                    'desc' => ['title' => SORT_DESC,],
                    'default' => SORT_DESC,
                    'label' => 'Наименование',
                ],
            ],
        ]);


        $query = ProductElastic::find(); // get a record by pk
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $filter = [];


        $filter['and'][] = ["term" => ["category_id" => $searchModel->category_id]];

        /*PRICE FILTER*/
        $price = [];

        if($searchModel->price_begin) {
            $price["gte"] = (int)$searchModel->price_begin;
        }

        if($searchModel->price_end) {
            $price["lte"] = (int)$searchModel->price_end;
        }

        if($price) {
            //$price['min_segment_size'] = 1;
            $filter['and'][] = ['range'=> ['price' => $price]];
        }


        /*OPTION FILTER*/

        if (isset(Yii::$app->request->queryParams['ProductAttribute'])) {
            foreach (Yii::$app->request->queryParams['ProductAttribute'] as $key => $attribute) {
                if ($attribute['value']) {
                    $option = [];
                    if (strpos($key, '_from')) {
                        $productAttributeModel[$key] = new ProductAttribute();
                        $productAttributeModel[$key]['value'] = $attribute['value'];

                        $option['gte'] = $attribute['value'];
                    } else if (strpos($key, '_to')) {
                        $productAttributeModel[$key] = new ProductAttribute();
                        $productAttributeModel[$key]['value'] = $attribute['value'];
                        $option['lte'] = $attribute['value'];

                    } else {
                        $productAttributeModel[$key]['value'] = $attribute['value'];
                        if(is_array($attribute['value'])){
                            //var_dump($attribute['value']); die;
                            $filter['and'][] = ["terms" => ['options.'.$key => $attribute['value'], "execution" => "and"]];
                        } else {
                            $filter['and'][] = ["term" => ['options.'.$key => $attribute['value']]];
                        }
                    }
                    if($option){
                        $filter['and'][] = ['range'=> ['options.'.str_replace(['_from', '_to'], '', $key) => $option]];
                    }
                }
            }
        }

        if($filter){
            $query->filter($filter);
        }

        $query->orderBy($sort->orders);


        return $this->render('list', [
            'productAttributeModel' => $productAttributeModel,
            'category' => $category,
            'searchModel' => $searchModel,
            'id' => $id,
            'dataProvider' => $dataProvider,
            'sort' => $sort,
        ]);
    }


    public function actionIndex() {

        $categories = Category::find()->where(['model_name' => 'product'])->all();

        return $this->render('index', [
            'categories' =>  $categories,
        ]);
    }

    public function actionCategory($slug) {


        $category = $this->findModel($slug);

        $products = Product::find()->where(['is_published' => '1', 'category_id'=>$category->id])->orderBy('id DESC')->all();



        return $this->render('test2', [
            'products' =>  $products,
            'category' =>  $category,
        ]);
    }
    protected function findModel($slug)
    {
        if (($model = Category::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



}