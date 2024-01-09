<?php

use common\models\Fatura;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Detalhesaluguer $model */

$this->title = $model->id_detalhes_aluguer;
$this->params['breadcrumbs'][] = ['label' => 'Detalhesaluguers', 'url' => ['/detalhesaluguer/index', 'id_user' => Yii::$app->user->getId()]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="detalhesaluguer-view">

    <h1><?= Html::encode($this->title)?></h1>


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
                'label' => 'Motociclo',
                'value' => function ($model) {
                    return $model->motociclo->marca . " " . $model->motociclo->modelo;
                }
            ],
            [
                'label' => 'Nome',
                'value' => function ($model) {
                    return $model->profile->nome . " " . $model->profile->apelido;
                }
            ],
            [
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
            [
                'label' => 'Preço total a pagar',
                'value' => function ($model) {

                    $precoExtras = 0;

                    foreach ($model->extraDetalhesAluguers as $extraDetalhesAl) {
                        $precoExtras += $extraDetalhesAl->extra->preco;
                    }
                    return ($model->motociclo->preco + $precoExtras + $model->seguro->preco) * $model->dias.' €';
                }
            ],
        ],
    ]);

    ?>

    <?php
    if ($fatura != null){
        echo Html::a('Ver fatura', ['fatura/view', 'detalhes_aluguer_fatura_id' => $model->id_detalhes_aluguer], ['class' => 'btn btn-primary']);
    }
    ?>


</div>
