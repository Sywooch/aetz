<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Category;

class CategorySearch extends Category
{

    public function rules()
    {
        return [
            [['id', 'created', 'updated', 'is_published', 'created_user_id', 'updated_user_id', 'sort_index', 'parent_id'], 'integer'],
            [['title', 'description', 'photo', 'meta_keywords', 'meta_description', 'slug', 'model_name', 'icon'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params, $model_name)
    {
        $query = Category::find()
            ->where(['model_name' => $model_name])
            ->orderBy('id DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created' => $this->created,
            'parent_id' => $this->parent_id,
            'updated' => $this->updated,
            'sort_index' => $this->sort_index,
            'created_user_id' => $this->updated,
            'updated_user_id' => $this->updated,
            'is_published' => $this->is_published,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'model_name', $this->model_name])
            ->andFilterWhere(['like', 'icon', $this->icon])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'meta_keywords', $this->meta_keywords])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
