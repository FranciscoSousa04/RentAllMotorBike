<?php

namespace common\models;

use Yii;

use common\models\UploadForm;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for table "Motociclo".
 *
 * @property int $id_Motociclo
 * @property string $marca
 * @property string $modelo
 * @property string $combustivel
 * @property float $preco
 * @property string $matricula
 * @property string $descricao
 * @property string $estado
 * @property int $tipo_Motociclo_id
 * @property int $localizacao_id
 * @property int $franquia 
 *
 * @property Assistencia[] $assistencias
 * @property DetalhesAluguer[] $detalhesAluguers
 * @property Imagem[] $imagems
 * @property Localizacao $localizacao
 * @property TipoMotociclo $tipoMotociclo
 */
class Motociclo extends \yii\db\ActiveRecord
{

    public $tipoMotociclos;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Motociclo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['marca', 'modelo', 'combustivel', 'preco', 'matricula', 'descricao', 'estado', 'tipo_Motociclo_id', 'localizacao_id', 'franquia'], 'required'],
            [['preco'], 'number'],
            [['estado'], 'string'],
            [['tipo_Motociclo_id', 'localizacao_id', 'franquia'], 'integer'],
            [['marca'], 'string', 'max' => 21],
            [['modelo'], 'string', 'max' => 31],
            [['combustivel', 'matricula'], 'string', 'max' => 9],
            [['descricao'], 'string', 'max' => 255],
            [['matricula'], 'unique'],
            [['localizacao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Localizacao::class, 'targetAttribute' => ['localizacao_id' => 'id_localizacao']],
            [['tipo_Motociclo_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoMotociclo::class, 'targetAttribute' => ['tipo_Motociclo_id' => 'id_tipo_Motociclo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_Motociclo' => 'Id Motociclo',
            'marca' => 'Marca',
            'modelo' => 'Modelo',
            'combustivel' => 'Combustivel',
            'preco' => 'Preco',
            'matricula' => 'Matricula',
            'descricao' => 'Descricao',
            'estado' => 'Estado',
            'tipo_Motociclo_id' => 'Categoria',
            'localizacao_id' => 'Localizacao carro',
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
        return $this->hasMany(Assistencia::class, ['Motociclo_id' => 'id_Motociclo']);
    }

    /**
     * Gets query for [[DetalhesAluguers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetalhesAluguers()
    {
        return $this->hasMany(DetalhesAluguer::class, ['Motociclo_id' => 'id_Motociclo']);
    }

    /**
     * Gets query for [[Imagems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImagems()
    {
        return $this->hasMany(Imagem::class, ['Motociclo_id' => 'id_Motociclo']);
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
     * Gets query for [[TipoMotociclo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoMotociclo()
    {
        return $this->hasOne(TipoMotociclo::class, ['id_tipo_Motociclo' => 'tipo_Motociclo_id']);
    }

}
