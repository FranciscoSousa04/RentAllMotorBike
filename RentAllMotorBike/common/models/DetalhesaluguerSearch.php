<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Detalhesaluguer;

/**
 * DetalhesaluguerSearch represents the model behind the search form of `common\models\Detalhesaluguer`.
 */
class DetalhesaluguerSearch extends Detalhesaluguer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_detalhes_aluguer', 'motociclo_id', 'profile_id', 'seguro_id', 'localizacao_levantamento_id', 'localizacao_devolucao_id'], 'integer'],
            [['data_inicio', 'data_fim'], 'safe'],
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
        $query = Detalhesaluguer::find();

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
            'id_detalhes_aluguer' => $this->id_detalhes_aluguer,
            'data_inicio' => $this->data_inicio,
            'data_fim' => $this->data_fim,
            'motociclo_id' => $this->motociclo_id,
            'profile_id' => $this->profile_id,
            'seguro_id' => $this->seguro_id,
            'localizacao_levantamento_id' => $this->localizacao_levantamento_id,
            'localizacao_devolucao_id' => $this->localizacao_devolucao_id,
        ]);

        return $dataProvider;
    }
}
