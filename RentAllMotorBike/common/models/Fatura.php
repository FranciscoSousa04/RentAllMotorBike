<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fatura".
 *
 * @property int $id_fatura
 * @property string $data_fatura
 * @property float $preco_total
 * @property int $detalhes_aluguer_fatura_id
 *
 * @property DetalhesAluguer $detalhesAluguerFatura
 * @property LinhaFatura[] $linhaFaturas
 */
class Fatura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fatura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data_fatura', 'preco_total', 'detalhes_aluguer_fatura_id'], 'required'],
            [['data_fatura'], 'safe'],
            [['preco_total'], 'number'],
            [['detalhes_aluguer_fatura_id'], 'integer'],
            [['detalhes_aluguer_fatura_id'], 'exist', 'skipOnError' => true, 'targetClass' => DetalhesAluguer::class, 'targetAttribute' => ['detalhes_aluguer_fatura_id' => 'id_detalhes_aluguer']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_fatura' => 'Id Fatura',
            'data_fatura' => 'Data Fatura',
            'preco_total' => 'Preco Total',
            'detalhes_aluguer_fatura_id' => 'Detalhes Aluguer Fatura ID',
        ];
    }

    /**
     * Gets query for [[DetalhesAluguerFatura]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalhesAluguerFatura()
    {
        return $this->hasOne(DetalhesAluguer::class, ['id_detalhes_aluguer' => 'detalhes_aluguer_fatura_id']);
    }

    /**
     * Gets query for [[LinhaFaturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLinhaFaturas()
    {
        return $this->hasMany(LinhaFatura::class, ['fatura_id' => 'id_fatura']);
    }
}
