<?php

use common\models\motociclo;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'motociclos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="motociclo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create motociclo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idmotociclo',
            'marca',
            'modelo',
            'descricao',
            'combustivel',
            //'preco',
            //'estado',
            //'tipo_motociclo_id',
            //'localizacao_id',
            //'franquia',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, motociclo $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idmotociclo' => $model->idmotociclo]);
                 }
            ],
        ],
    ]); ?>


</div>
