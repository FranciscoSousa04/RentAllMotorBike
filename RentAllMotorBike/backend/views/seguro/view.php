<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Seguro $model */

$this->title = $model->id_seguro;
$this->params['breadcrumbs'][] = ['label' => 'Seguros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="seguro-view">


    <p>
        <?= Html::a('Update', ['update', 'id_seguro' => $model->id_seguro], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_seguro' => $model->id_seguro], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_seguro',
            'marca',
            'cobertura',
            [
                'label' => 'Preço diário',
                'value' => function ($model) {
                    {
                        return $model->preco . '€';
                    }
                }
            ],
        ],
    ]) ?>

</div>
