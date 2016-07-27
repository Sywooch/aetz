<?php

namespace common\models\search;

use common\models\Category;
use common\models\City;
use common\models\ProductParam;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;
use yii\helpers\ArrayHelper;
/**
 * ObjectSearch represents the model behind the search form about `common\models\Object`.
 */
class ProductFilterSearch extends Product
{

    public $price_begin;
    public $price_end;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price_begin', 'price_end', 'id', 'category_id', 'price', 'created', 'updated'], 'integer'],
            [['title', 'short_description', 'slug', 'meta_keywords', 'meta_description'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $categoryId = 0, $is_map= false)
    {
        $query = Product::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if($categoryId){
            if(!$this->category_id){
                $this->category_id = $categoryId;
            }
        }
        $query->andFilterWhere([
//            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
//            'sort_index' => $this->sort_index,
            'is_published' => 1,
//            'city_id' => City::getDefaultCity(),
//            'status' => $this->status,
            'created' => $this->created,
            'updated' => $this->updated,
//            'deleted' => $this->deleted,
        ]);

        if($this->price_begin){
            $query->andWhere(['>=','price',$this->price_begin]);
        }
        if($this->price_end){
            $query->andWhere(['<=','price',$this->price_end]);
        }
        if($is_map){
            $query->andWhere(['>','latitude', 0]);
            $query->andWhere(['>','longitude', 0]);
        }


        if(isset($params['ProductParam'])){


            foreach($params['ProductParam'] as $key => $param){
                if($param['value']){

                    $subquery = ProductParam::find()->select('object_id');
                    if(strpos($key, '_from')){
                        $subquery->andWhere(['attribute_id' => str_replace('_from', '', $key)]);
                        $subquery->andWhere([ '>', 'value', $param['value']]);


                    } else if(strpos($key, '_to')){
                        $subquery->andWhere(['attribute_id' => str_replace('_to', '', $key)]);
                        $subquery->andWhere([ '<=', 'value', $param['value']]);
                    
                    }else{
                        $subquery->andWhere(['attribute_id' => $key, 'value' => $param['value']]);

                    }

                    $query->andWhere(['in', 'id', $subquery]);

                }
            }
        }

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'meta_keywords', $this->meta_keywords])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description]);


        if($this->id){
            $query->where(['id' => $this->id]);
        }

        $query->orderBy('created DESC');


        return $dataProvider;
    }
}
