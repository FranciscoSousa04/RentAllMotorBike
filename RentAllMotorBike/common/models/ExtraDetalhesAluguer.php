<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "extra_detalhes_aluguer".
 *
 * @property int $id_extra_detalhes_aluguer
 * @property int $extra_id
 * @property int $detalhes_aluguer_id
 *
 * @property DetalhesAluguer $detalhesAluguer
 * @property Extra $extra
 */
class ExtraDetalhesAluguer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'extra_detalhes_aluguer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['extra_id', 'detalhes_aluguer_id'], 'required'],
            [['extra_id', 'detalhes_aluguer_id'], 'integer'],
            [['extra_id'], 'exist', 'skipOnError' => true, 'targetClass' => Extra::class, 'targetAttribute' => ['extra_id' => 'id_extra']],
            [['detalhes_aluguer_id'], 'exist', 'skipOnError' => true, 'targetClass' => DetalhesAluguer::class, 'targetAttribute' => ['detalhes_aluguer_id' => 'id_detalhes_aluguer']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_extra_detalhes_aluguer' => 'Id Extra Detalhes Aluguer',
            'extra_id' => 'Extra ID',
            'detalhes_aluguer_id' => 'Detalhes Aluguer ID',
        ];
    }

    /**
     * Gets query for [[DetalhesAluguer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalhesAluguer()
    {
        return $this->hasOne(DetalhesAluguer::class, ['id_detalhes_aluguer' => 'detalhes_aluguer_id']);
    }

    /**
     * Gets query for [[Extra]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExtra()
    {
        return $this->hasOne(Extra::class, ['id_extra' => 'extra_id']);
    }
}
