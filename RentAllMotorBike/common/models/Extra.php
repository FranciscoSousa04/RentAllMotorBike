<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "extra".
 *
 * @property int $id_extra
 * @property string $descricao
 * @property float $preco
 *
 * @property ExtraDetalhesAluguer[] $extraDetalhesAluguers
 */
class Extra extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'extra';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao', 'preco'], 'required'],
            [['preco'], 'number'],
            [['descricao'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_extra' => 'Id Extra',
            'descricao' => 'Descricao',
            'preco' => 'Preco',
        ];
    }

    /**
     * Gets query for [[ExtraDetalhesAluguers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExtraDetalhesAluguers()
    {
        return $this->hasMany(ExtraDetalhesAluguer::class, ['extra_id' => 'id_extra']);
    }
}
