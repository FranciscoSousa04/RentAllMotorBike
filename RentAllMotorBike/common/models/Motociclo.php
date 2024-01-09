<?php

namespace common\models;

use Yii;

use common\models\UploadForm;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for table "motociclo".
 *
 * @property int $idmotociclo
 * @property string $marca
 * @property string $modelo
 * @property string $combustivel
 * @property float $preco
 * @property string $descricao
 * @property string $estado
 * @property int $tipo_motociclo_id
 * @property int $localizacao_id
 * @property int $franquia 
 *
 * @property Assistencia[] $assistencias
 * @property DetalhesAluguer[] $detalhesAluguers
 * @property Imagem[] $imagems
 * @property Localizacao $localizacao
 * @property Tipomotociclo $tipomotociclo
 */
class Motociclo extends \yii\db\ActiveRecord
{

    public $tipomotociclos;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'motociclo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['marca', 'modelo', 'combustivel', 'preco', 'descricao', 'estado', 'tipo_motociclo_id', 'localizacao_id', 'franquia'], 'required'],
            [['preco'], 'number'],
            [['estado'], 'string'],
            [['idmotociclo', 'localizacao_id', 'franquia'], 'integer'],
            [['marca'], 'string', 'max' => 21],
            [['modelo'], 'string', 'max' => 31],
            [['combustivel'], 'string', 'max' => 9],
            [['descricao'], 'string', 'max' => 255],
            [['localizacao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Localizacao::class, 'targetAttribute' => ['localizacao_id' => 'id_localizacao']],
            [['tipo_motociclo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipomotociclo::class, 'targetAttribute' => ['tipo_motociclo_id' => 'id_tipo_motociclo']],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idmotociclo' => 'Id motociclo',
            'marca' => 'Marca',
            'modelo' => 'Modelo',
            'combustivel' => 'Combustivel',
            'preco' => 'Preco',
            'descricao' => 'Descricao',
            'estado' => 'Estado',
            'tipo_motociclo_id' => 'Categoria',
            'localizacao_id' => 'Localizacao motociclo',
            'franquia' => 'Franquia',
        ];
    }

    /**
     * Gets query for [[Assistencias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssistencias()
    {
        return $this->hasMany(Assistencia::class, ['motociclo_id' => 'idmotociclo']);
    }

    /**
     * Gets query for [[DetalhesAluguers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalhesAluguers()
    {
        return $this->hasMany(DetalhesAluguer::class, ['motociclo_id' => 'idmotociclo']);
    }

    /**
     * Gets query for [[Imagems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagems()
    {
        return $this->hasMany(Imagem::class, ['motociclo_id_imagem' => 'idmotociclo']);
    }

    /**
     * Gets query for [[Localizacao]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocalizacao()
    {
        return $this->hasOne(Localizacao::class, ['id_localizacao' => 'localizacao_id']);
    }

    /**
     * Gets query for [[Tipomotociclo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipomotociclo()
    {
        return $this->hasOne(Tipomotociclo::class, ['id_tipo_motociclo' => 'tipo_motociclo_id']);
    }

}
