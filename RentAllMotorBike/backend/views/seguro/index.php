<?php

use common\models\Seguro;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\SeguroSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Seguros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seguro-index">


    <p>
        <?= Html::a('Create Seguro', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'id_seguro',
            'marca',
            'cobertura',
            [
                'label' => 'Preço',
                'value' => function ($model) {
                    return $model->preco.'€';
                }
            ],            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Seguro $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_seguro' => $model->id_seguro]);
                 }
            ],
        ],
    ]); ?>


</div>
