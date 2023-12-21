<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Tipomotociclo $model */

$this->title = $model->id_tipo_motociclo;
$this->params['breadcrumbs'][] = ['label' => 'Tipo motociclos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tipo-motociclo-view">

    <p>
        <?= Html::a('Update', ['update', 'id_tipo_motociclo' => $model->id_tipo_motociclo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_tipo_motociclo' => $model->id_tipo_motociclo], [
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
            'id_tipo_motociclo',
            'categoria',
        ],
    ]) ?>

</div>
