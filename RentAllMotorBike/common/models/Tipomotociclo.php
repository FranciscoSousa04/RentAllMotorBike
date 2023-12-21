<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipo_Motociclo".
 *
 * @property int $id_tipo_Motociclo
 * @property string $categoria
 *
 * @property Motociclo[] $Motociclos
 */
class TipoMotociclo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_Motociclo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categoria'], 'required'],
            [['categoria'], 'string', 'max' => 21],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_Motociclo' => 'Id Tipo Motociclo',
            'categoria' => 'Categoria',
        ];
    }

    /**
     * Gets query for [[Motociclos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMotociclos()
    {
        return $this->hasMany(Motociclo::class, ['tipo_Motociclo_id' => 'id_tipo_Motociclo']);
    }
}
