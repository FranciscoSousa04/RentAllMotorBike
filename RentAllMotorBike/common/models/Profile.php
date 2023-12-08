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
 *
 * @property User $uprofile
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
            [['id_profile', 'nome', 'apelido', 'telemovel', 'nif', 'nr_cartaconducao'], 'required'],
            [['id_profile', 'telemovel', 'nif'], 'integer'],
            [['nome', 'apelido'], 'string', 'max' => 21],
            [['nr_cartaconducao'], 'string', 'max' => 12],
            [['telemovel'], 'unique'],
            [['nif'], 'unique'],
            [['nr_cartaconducao'], 'unique'],
            [['id_profile'], 'unique'],
            [['id_profile'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_profile' => 'id']],

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
            'nr_cartaconducao' => 'Nr Carta Conducao',
        ];
    }
    public function getProfile()
    {
        return $this->hasOne(User::class, ['id' => 'id_profile']);
    }
}
