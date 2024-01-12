<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Localizacao;

/**
 * LocalizacaoSearch represents the model behind the search form of `common\models\Localizacao`.
 */
class LocalizacaoSearch extends Localizacao
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_localizacao'], 'integer'],
            [['localizacao', 'morada', 'cod_postal'], 'safe'],
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
        $query = Localizacao::find();

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
            'id_localizacao' => $this->id_localizacao,
        ]);

        $query->andFilterWhere(['like', 'localizacao', $this->localizacao])
            ->andFilterWhere(['like', 'morada', $this->morada])
            ->andFilterWhere(['like', 'cod_postal', $this->cod_postal]);

        return $dataProvider;
    }
}
