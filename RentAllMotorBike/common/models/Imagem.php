<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "imagem".
 *
 * @property int $id_imagem
 * @property string $imagem
 * @property int $Motociclo_id
 *
 * @property Motociclo $Motociclo
 */
class Imagem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'imagem';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imagem', 'Motociclo_id'], 'required'],
            [['Motociclo_id'], 'integer'],
            [['imagem'], 'string', 'max' => 81],
            [['Motociclo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Motociclo::class, 'targetAttribute' => ['Motociclo_id' => 'idmotociclo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_imagem' => 'Id Imagem',
            'imagem' => 'Imagem',
            'Motociclo_id' => 'Motociclo ID',
        ];
    }

    /**
     * Gets query for [[Motociclo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMotociclo()
    {
        return $this->hasOne(Motociclo::class, ['idmotociclo' => 'Motociclo_id']);
    }
}
