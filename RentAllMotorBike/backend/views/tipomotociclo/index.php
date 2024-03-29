<?php

use common\models\Tipomotociclo;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\TipomotocicloSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tipo motociclos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipomotociclo-index">


    <p>
        <?= Html::a('Create Tipo motociclo', ['create'], ['class' => 'btn btn-success','id' => 'create-tipomotociclo']) ?>
    </p>




    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'id_tipo_motociclo',
            'categoria',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Tipomotociclo $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_tipo_motociclo' => $model->id_tipo_motociclo]);
                 }
            ],
        ],
    ]); ?>


</div>
