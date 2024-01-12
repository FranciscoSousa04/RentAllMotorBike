<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Fatura $model */

$this->title = $model->id_fatura;
$this->params['breadcrumbs'][] = ['label' => 'Faturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="fatura-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'data_fatura',
                'format' => ['date', 'php:d-m-Y']
            ],
            [
                'label' => 'Duração',
                'value' => function ($model) {
                    return $model->detalhesAluguerFatura->data_inicio . ' a ' . $model->detalhesAluguerFatura->data_fim;
                }
            ],
            'detalhes_aluguer_fatura_id',
            [
                'label' => 'motociclo',
                'value' => function ($model) {
                    return $model->detalhesAluguerFatura->motociclo->marca;
                }
            ],
            [
                'label' => 'Seguro',
                'value' => function ($model) {
                    return $model->detalhesAluguerFatura->seguro->cobertura;
                }
            ],
            [
                'label' => 'Localizacao de recolha',
                'value' => function ($model) {
                    return $model->detalhesAluguerFatura->localizacaoDevolucao->morada;
                }
            ],
            [
                'label' => 'Localizacao de devolucao',
                'value' => function ($model) {
                    return $model->detalhesAluguerFatura->localizacaoDevolucao->morada;
                }
            ],
            [
                'label' => 'Extra',
                'value' => function ($model) {
                    $testeArray = '';

                    foreach ($model->detalhesAluguerFatura->extraDetalhesAluguers as $extraDetalhesAl) {

                        if (count($model->detalhesAluguerFatura->extraDetalhesAluguers) > 1) {
                            $testeArray = $testeArray . $extraDetalhesAl->extra->descricao . ', ';
                        } else {
                            $testeArray = $extraDetalhesAl->extra->descricao;
                        }
                    }
                    return $testeArray;
                }
            ],
            [
                'label' => 'Preço diário motociclo',
                'value' => function ($model) {
                    return $model->detalhesAluguerFatura->motociclo->preco . '€';
                }
            ],
            [
                'label' => 'Preço diário extras',
                'value' => function ($model) {
                    $testeArray = 0;

                    foreach ($model->detalhesAluguerFatura->extraDetalhesAluguers as $extraDetalhesAl) {

                        if (count($model->detalhesAluguerFatura->extraDetalhesAluguers) > 1) {
                            $testeArray = $testeArray + $extraDetalhesAl->extra->preco ;
                        } else {
                            $testeArray = $extraDetalhesAl->extra->preco . '€';
                        }
                    }
                    return $testeArray;
                }
            ],
            [
                'label' => 'Preço total',
                'value' => function ($model) {

                    return $model->preco_total . '€';
                }
            ],
        ],
    ]) ?>

</div>
