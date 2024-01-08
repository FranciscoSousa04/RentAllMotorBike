<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "assistencia".
 *
 * @property int $id_assistencia
 * @property string $data_pedido
 * @property string $mensagem
 * @property string $localizacao
 * @property string $condicao
 * @property int $motociclo_id_assistencia
 * @property int $uprofile_id
 *
 * @property Profile $profile
 * @property Motociclo $Motociclo
 */
class Assistencia extends \yii\db\ActiveRecord
{

    public $MotocicloDrop, $condicaoDrop;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assistencia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data_pedido', 'mensagem', 'localizacao', 'motociclo_id_assistencia', 'uprofile_id'], 'required'],
            [['data_pedido'], 'safe'],
            [['condicao'], 'string'],
            [['motociclo_id_assistencia', 'uprofile_id'], 'integer'],
            [['mensagem'], 'string', 'max' => 91],
            [['localizacao'], 'string', 'max' => 51],
            [['uprofile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['profile_id' => 'id_profile']],
            [['motociclo_id_assistencia'], 'exist', 'skipOnError' => true, 'targetClass' => Motociclo::class, 'targetAttribute' => ['motociclo_id_assistencia' => 'idmotociclo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_assistencia' => 'Id Assistencia',
            'data_pedido' => 'Data Pedido',
            'mensagem' => 'Mensagem',
            'localizacao' => 'Localizacao',
            'condicao' => 'Condicao',
            'Motociclo_id' => 'Motociclo ID',
            'profile_id' => 'Profile ID',
        ];
    }

    /**
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['id_profile' => 'profile_id']);
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
