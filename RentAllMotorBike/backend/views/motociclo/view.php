<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Motociclo $model */

$this->title = $model->idmotociclo;
$this->params['breadcrumbs'][] = ['label' => 'Motociclos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="motociclo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idmotociclo' => $model->idmotociclo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idmotociclo' => $model->idmotociclo], [
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
            'idmotociclo',
            'marca',
            'modelo',
            'descricao',
            'combustivel',
            'preco',
            'estado',
            'tipo_motociclo_id',
            'localizacao_id',
            'franquia',
        ],
    ]) ?>

</div>
