<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\motociclo;

/**
 * motocicloSearch represents the model behind the search form of `common\models\motociclo`.
 */
class motocicloSearch extends motociclo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idmotociclo', 'tipo_motociclo_id', 'localizacao_id', 'franquia'], 'integer'],
            [['marca', 'modelo', 'combustivel','descricao', 'estado', 'franquia'], 'safe'],
            [['preco'], 'number'],
            [['tipomotociclos'], 'safe'],
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
        $query = motociclo::find();

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

        
        if($this->tipomotociclos){
            $query->join('INNER JOIN','tipo_motociclo','tipo_motociclo.id_tipo_motociclo = tipo_motociclo_id')
            ->andFilterWhere(['motociclo.tipo_motociclo_id' => $this->tipomotociclos]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idmotociclo' => $this->idmotociclo,
            'preco' => $this->preco,
            'tipo_motociclo_id' => $this->tipo_motociclo_id,
            'localizacao_id' => $this->localizacao_id,
            'franquia' => $this->franquia,
        ]);

        $query->andFilterWhere(['like', 'marca', $this->marca])
            ->andFilterWhere(['like', 'modelo', $this->modelo])
            ->andFilterWhere(['like', 'combustivel', $this->combustivel])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'estado', $this->estado]);

        return $dataProvider;
    }
}
