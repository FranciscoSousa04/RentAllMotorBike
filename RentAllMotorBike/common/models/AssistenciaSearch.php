<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Assistencia;

/**
 * AssistenciaSearch represents the model behind the search form of `common\models\Assistencia`.
 */
class AssistenciaSearch extends Assistencia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_assistencia', 'motociclo_id_assistencia', 'uprofile_id'], 'integer'],
            [['data_pedido', 'mensagem', 'localizacao', 'condicao'], 'safe'],
            [['MotocicloDrop', 'condicaoDrop'], 'safe']
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
        $query = Assistencia::find();

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

        if($this->MotocicloDrop){
            $query->join('INNER JOIN','Motociclo','Motociclo.idmotociclo = assistencia.Motociclo_id')
            ->andFilterWhere(['assistencia.motociclo_id_assistencia' => $this->MotocicloDrop]);
       }

       if($this->condicaoDrop){
            $query->join('INNER JOIN','Motociclo','Motociclo.idmotociclo = assistencia.Motociclo_id')
            ->andFilterWhere(['assistencia.condicao' => $this->condicaoDrop]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_assistencia' => $this->id_assistencia,
            'data_pedido' => $this->data_pedido,
            'motociclo_id_assistencia' => $this->motociclo_id_assistencia,
            'uprofile_id' => $this->uprofile_id,
        ]);

        $query->andFilterWhere(['like', 'mensagem', $this->mensagem])
            ->andFilterWhere(['like', 'localizacao', $this->localizacao]);

        return $dataProvider;
    }
}
