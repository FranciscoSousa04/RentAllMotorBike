<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Assistencia $model */

$this->title = $model->id_assistencia;
$this->params['breadcrumbs'][] = ['label' => 'Assistencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="assistencia-view">


    <p>
        <?= Html::a('Update', ['update', 'id_assistencia' => $model->id_assistencia], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_assistencia' => $model->id_assistencia], [
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
            'id_assistencia',
            'data_pedido',
            'mensagem',
            'localizacao',
            'condicao',
            [
                'label' => 'motociclo',
                'attribute' => 'motocicloDrop',
                'format' => 'raw',
                'value' => function($model){
                    return $model->motociclo->marca . " " . $model->motociclo->modelo;
                }
            ],
            [
                'label' => 'Perfil',
                'format' => 'raw',
                'value' => function($model){
                    return $model->profile->nome ;
                }
            ],
        ],
    ]) ?>

</div>
