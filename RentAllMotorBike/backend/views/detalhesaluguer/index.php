<?php

use common\models\Detalhesaluguer;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\DetalhesaluguerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Detalhes aluguer';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detalhesaluguer-index">

    <p>
        <?php // Html::a('Create Detalhesaluguer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
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
                    return $model->motociclo->marca ." ".$model->motociclo->modelo;
                }
            ],
            [
                'label' => 'Localizacao de recolha',
                'value' => 'localizacaoLevantamento.morada',
            ],
            [
                'label' => 'Localizacao de devolucao',
                'value' => 'localizacaoDevolucao.morada'
            ],

            [
                'label' => 'Profile',
                'value' => function ($model) {
                    return $model->profile->nome . " " . $model->profile->apelido;
                }
            ],
            //'seguro_id',
            //'localizacao_levantamento_id',
            //'localizacao_devolucao_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Detalhesaluguer $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_detalhes_aluguer' => $model->id_detalhes_aluguer]);
                 }
            ],
        ],
    ]); ?>


</div>
