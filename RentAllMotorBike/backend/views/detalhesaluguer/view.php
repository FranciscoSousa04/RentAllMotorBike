<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Detalhesaluguer $model */

$this->title = $model->id_detalhes_aluguer;
$this->params['breadcrumbs'][] = ['label' => 'Detalhesaluguers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="detalhesaluguer-view">

    <p>
        <?= Html::a('Update', ['update', 'id_detalhes_aluguer' => $model->id_detalhes_aluguer], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_detalhes_aluguer' => $model->id_detalhes_aluguer], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php if($fatura==null) {
            echo Html::a('Emitir fatura', ['fatura/create', 'id_detalhes_aluguer' => $model->id_detalhes_aluguer], ['class' => 'btn btn-success']);
       } else{
            echo Html::a('Ver fatura', ['fatura/view', 'detalhes_aluguer_fatura_id' => $model->id_detalhes_aluguer], ['class' => 'btn btn-success']);}
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'data_inicio',
                'format' => ['date', 'php:d-m-Y']
            ],
            [
                'attribute' => 'data_fim',
                'format' => ['date', 'php:d-m-Y']
            ],
            [
                'label' => 'Carro',
                'value' => function ($model) {
                    return $model->motociclo->marca . " " . $model->motociclo->modelo;
                }
            ],
            [
                'label' => 'Nome',
                'value' => function ($model) {
                    return $model->profile->nome . " " . $model->profile->apelido;
                }
            ], [
                'label' => 'Tipo de seguro',
                'value' => function ($model) {
                    return $model->seguro->cobertura;
                }
            ],
            [
                'label' => 'Localizacao de recolha',
                'value' => function ($model) {
                    return $model->localizacaoLevantamento->morada;
                }
            ],
            [
                'label' => 'Localizacao de devolucao',
                'value' => function ($model) {
                    return $model->localizacaoDevolucao->morada;
                }
            ],
            [
                'label' => 'Extra',
                'value' => function ($model) {
                    $stringExtras = '';
                    $nrExtras = count($model->extraDetalhesAluguers);

                    if($nrExtras == 0){
                        $stringExtras = 'Sem extras';
                    }else{
                        foreach ($model->extraDetalhesAluguers as $extraDetalhesAl) {

                            //adicionar a $stringExtras o extra
                            $stringExtras = $stringExtras . $extraDetalhesAl->extra->descricao;
    
                            //caso haja + do que 1 extra é adicionada uma virgula no fim da $stringExtras
                            if ($nrExtras > 1){
                                $stringExtras = $stringExtras . ', ';
                                $nrExtras--;
                            }
                        }
                    }
                    return $stringExtras;
                }
            ],
        ],
    ]) ?>

</div>
