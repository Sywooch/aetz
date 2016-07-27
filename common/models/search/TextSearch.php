<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Text;

/**
 * SettingsSearch represents the model behind the search form about `common\models\Text`.
 */
class TextSearch extends Text
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created', 'updated', 'created_user_id', 'updated_user_id', 'lang_id'], 'integer'],
            [['key', 'value'], 'safe'],
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
    public function search($params)
    {
        $query = Text::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created' => $this->created,
            'updated' => $this->updated,
            'created_user_id' => $this->created_user_id,
            'updated_user_id' => $this->updated_user_id,
            'lang_id' => $this->lang_id,
        ]);

        $query->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }
}
