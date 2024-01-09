<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\motociclo $model */

$this->title = $model->marca . " " . $model->modelo;;
$this->params['breadcrumbs'][] = ['label' => 'motociclos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="motociclo-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'marca',
            'modelo',
            'combustivel',
            'matricula',
            'descricao',
            [
                'label' => 'Tipo motociclo',
                'attribute' => 'tipomotociclos',
                'value' => function ($model) {
                    {
                        return $model->tipomotociclo->categoria;
                    }
                }
            ],
            [
                'label' => 'Preço diário',
                'value' => function ($model) {
                    {
                        return $model->preco .'€';
                    }
                }
            ],
            [
                'label' => 'Franquia',
                'value' => function ($model) {
                    {
                        return $model->franquia . '€';
                    }
                }
            ],
        ],
    ]) ?>

    <?= Html::a('Reservar', ['/detalhesaluguer/create', 'idmotociclo' => $model->idmotociclo], ['class' => 'btn btn-primary', 'name' => 'btnReservar']); ?>

    <br>
    <br>
    <div class="owl-carousel testimonial-carousel">
        <?php
        foreach ($model->imagems as $imagem) { ?>
        <div class="testimonial-item d-flex flex-column justify-content-center ">
                    <?= Html::img('@web/uploads/' . $imagem->imagem) ?>
            </div>

            <?php
        }
        ?>
    </div>


