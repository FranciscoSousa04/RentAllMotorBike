<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipo_motociclo".
 *
 * @property int $id_tipo_motociclo
 * @property string $categoria
 *
 * @property motociclo[] $motociclos
 */
class Tipomotociclo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_motociclo';
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
            'id_tipo_motociclo' => 'Id Tipo motociclo',
            'categoria' => 'Categoria',
        ];
    }

    /**
     * Gets query for [[motociclos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getotociclos()
    {
        return $this->hasMany(motociclo::class, ['tipo_motociclo_id' => 'id_tipo_motociclo']);
    }
}
