<?php

use common\models\Assistencia;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\AssistenciaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Assistencias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assistencia-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Assistencia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_assistencia',
            'data_pedido',
            'mensagem',
            'localizacao',
            'motociclo_id',
            //'profile_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Assistencia $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_assistencia' => $model->id_assistencia]);
                 }
            ],
        ],
    ]); ?>


</div>
