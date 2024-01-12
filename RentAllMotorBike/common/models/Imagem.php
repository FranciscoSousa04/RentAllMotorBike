<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "imagem".
 *
 * @property int $id_imagem
 * @property string $imagem
 * @property int $motociclo_id
 *
 * @property motociclo $motociclo
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
            [['imagem', 'motociclo_id'], 'required'],
            [['motociclo_id'], 'integer'],
            [['imagem'], 'string', 'max' => 81],
            [['motociclo_id'], 'exist', 'skipOnError' => true, 'targetClass' => motociclo::class, 'targetAttribute' => ['motociclo_id' => 'idmotociclo']],
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
            'motociclo_id' => 'motociclo ID',
        ];
    }

    /**
     * Gets query for [[motociclo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getmotociclo()
    {
        return $this->hasOne(motociclo::class, ['idmotociclo' => 'motociclo_id']);
    }
}
