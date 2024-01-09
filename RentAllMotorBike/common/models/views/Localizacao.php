<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "localizacao".
 *
 * @property int $id_localizacao
 * @property string $localizacao
 * @property string $morada
 * @property string $cod_postal
 *
 * @property DetalhesAluguer[] $detalhesAluguerLevantamento
 * @property DetalhesAluguer[] $detalhesAluguerDevolucao
 * @property motociclo[] $motociclos
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
            [['localizacao', 'morada', 'cod_postal'], 'required'],
            [['localizacao'], 'string', 'max' => 51],
            [['morada'], 'string', 'max' => 71],
            [['cod_postal'], 'string', 'max' => 9],
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
            'cod_postal' => 'Cod Postal',
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
     * Gets query for [[motociclos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getmotociclos()
    {
        return $this->hasMany(motociclo::class, ['localizacao_id' => 'id_localizacao']);
    }
}
