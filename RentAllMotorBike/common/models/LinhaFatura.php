<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "linha_fatura".
 *
 * @property int $id_linha_fatura
 * @property string $descricao
 * @property float $preco
 * @property int $fatura_id
 *
 * @property Fatura $fatura
 */
class LinhaFatura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'linha_fatura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao', 'fatura_id'], 'required'],
            [['preco'], 'number'],
            [['fatura_id'], 'integer'],
            [['descricao'], 'string', 'max' => 255],
            [['fatura_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fatura::class, 'targetAttribute' => ['fatura_id' => 'id_fatura']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_linha_fatura' => 'Id Linha Fatura',
            'descricao' => 'Descricao',
            'preco' => 'Preco',
            'fatura_id' => 'Fatura ID',
        ];
    }

    /**
     * Gets query for [[Fatura]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFatura()
    {
        return $this->hasOne(Fatura::class, ['id_fatura' => 'fatura_id']);
    }
}
