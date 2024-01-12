<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "seguro".
 *
 * @property int $id_seguro
 * @property string $marca
 * @property string $cobertura
 * @property float $preco
 *
 * @property DetalhesAluguer[] $detalhesAluguers
 */
class Seguro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seguro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['marca', 'cobertura', 'preco'], 'required'],
            [['preco'], 'number'],
            [['marca'], 'string', 'max' => 51],
            [['cobertura'], 'string', 'max' => 81],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_seguro' => 'Id Seguro',
            'marca' => 'Marca',
            'cobertura' => 'Cobertura',
            'preco' => 'Preco',
        ];
    }

    /**
     * Gets query for [[DetalhesAluguers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalhesAluguers()
    {
        return $this->hasMany(DetalhesAluguer::class, ['seguro_id' => 'id_seguro']);
    }
}
