<?php

use common\models\Analise;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\AnaliseSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Avaliação';
$this->params['breadcrumbs'][] = $this->title;


?>

<div class="analise-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Avaliação', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            [
                'label' => 'Analise',
                'value' => function ($model) {
                    return $model->id_analise;
                }
            ],
            'comentario',

            [
                'label' => 'Classificação',
                'value' => function ($model) {
                    return $model->classificao."★";
                }
            ],
            [
                'attribute' => 'data_analise',
                'format' => ['date', 'php:Y-m-d']
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Analise $model, $key, $index, $column) {

                    return Url::toRoute([$action, 'id_analise' => $model->id_analise]);
                }
            ],
        ],
    ]); ?>



</div>
