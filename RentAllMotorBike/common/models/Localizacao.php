<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "localizacao".
 *
 * @property int $id_localizacao
 * @property string $localizacao
 * @property string $morada
 * @property string $codigo_postal
 *
 * @property DetalhesAluguer[] $detalhesAluguerLevantamento
 * @property DetalhesAluguer[] $detalhesAluguerDevolucao
 * @property Motociclo[] $Motociclos
 */
class Localizacao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'localizacao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['localizacao', 'morada', 'codigo_postal'], 'required'],
            [['localizacao'], 'string', 'max' => 51],
            [['morada'], 'string', 'max' => 71],
            [['codigo_postal'], 'string', 'max' => 9],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_localizacao' => 'Id Localizacao',
            'localizacao' => 'Localizacao',
            'morada' => 'Morada',
            'codigo_postal' => 'Codigo Postal',
        ];
    }

    /**
     * Gets query for [[DetalhesAluguerLevantamento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalhesAluguerLevantamento()
    {
        return $this->hasMany(DetalhesAluguer::class, ['localizacao_levantamento_id' => 'id_localizacao']);
    }

    /**
     * Gets query for [[DetalhesAluguerDevolucao]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalhesAluguerDevolucao()
    {
        return $this->hasMany(DetalhesAluguer::class, ['localizacao_devolucao_id' => 'id_localizacao']);
    }

    /**
     * Gets query for [[Motociclos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMotociclos()
    {
        return $this->hasMany(Motociclo::class, ['localizacao_id' => 'id_localizacao']);
    }
}
