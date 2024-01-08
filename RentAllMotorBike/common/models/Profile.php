<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "uprofile".
 *
 * @property int $id_profile
 * @property string $nome
 * @property string $apelido
 * @property int $telemovel
 * @property int $nif
 * @property string $nr_cartaconducao
 * @property int $id_user
 *
 * @property Analise[] $analises
 * @property Assistencia[] $assistencias
 * @property CarrinhoCompras[] $carrinhoCompras
 * @property DetalhesAluguer[] $detalhesAluguers
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uprofile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'apelido', 'telemovel', 'nif', 'nr_cartaconducao', 'id_user'], 'required'],
            [['telemovel', 'nif', 'id_user'], 'integer'],
            [['nome', 'apelido', 'nr_cartaconducao'], 'string', 'max' => 20],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_profile' => 'Id Profile',
            'nome' => 'Nome',
            'apelido' => 'Apelido',
            'telemovel' => 'Telemovel',
            'nif' => 'Nif',
            'nr_cartaconducao' => 'Nr Cartaconducao',
            'id_user' => 'Id User',
        ];
    }

    /**
     * Gets query for [[Analises]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnalises()
    {
        return $this->hasMany(Analise::class, ['uprofile_id' => 'id_profile']);
    }

    /**
     * Gets query for [[Assistencias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssistencias()
    {
        return $this->hasMany(Assistencia::class, ['uprofile_id' => 'id_profile']);
    }

    /**
     * Gets query for [[CarrinhoCompras]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarrinhoCompras()
    {
        return $this->hasMany(CarrinhoCompras::class, ['utilizador_id' => 'id_profile']);
    }

    /**
     * Gets query for [[DetalhesAluguers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalhesAluguers()
    {
        return $this->hasMany(DetalhesAluguer::class, ['profile_id' => 'id_profile']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }
}