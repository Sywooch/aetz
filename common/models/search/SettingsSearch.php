<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Settings;

/**
 * SettingsSearch represents the model behind the search form about `common\models\Settings`.
 */
class SettingsSearch extends Settings
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created', 'updated', 'created_user_id', 'updated_user_id'], 'integer'],
            [['key', 'value', 'comment'], 'safe'],
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
        $query = Settings::find();

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
        ]);

        $query->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
