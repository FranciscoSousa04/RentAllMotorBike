<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Analise;

/**
 * AnaliseSearch represents the model behind the search form of `common\models\Analise`.
 */
class AnaliseSearch extends Analise
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_analise', 'classificao', 'profile_id'], 'integer'],
            [['comentario', 'data_analise'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Analise::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_analise' => $this->id_analise,
            'classificao' => $this->classificao,
            'data_analise' => $this->data_analise,
            'profile_id' => $this->profile_id,
        ]);

        $query->andFilterWhere(['like', 'comentario', $this->comentario]);

        return $dataProvider;
    }
}
