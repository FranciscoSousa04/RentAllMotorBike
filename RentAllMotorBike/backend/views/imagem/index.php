<?php

use common\models\Imagem;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\ImagemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Imagem';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imagem-index">


    <p>
        <?= Html::a('Create Imagem', ['imagem/create', 'idmotociclo' => $motociclo->idmotociclo],['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'id_imagem',
            'imagem',
            [
                'label' => 'motociclo ',
                'format'=>'raw',
                'value' => function ($model) {
                    {
                        return Html::img('@web/uploads/' . $model->imagem,['width' => '400', 'height' => '300']);

                    }
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Imagem $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_imagem' => $model->id_imagem]);
                }
            ],
        ],
    ]); ?>



</div>
