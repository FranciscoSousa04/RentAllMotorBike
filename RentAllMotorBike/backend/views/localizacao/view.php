<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Localizacao $model */

$this->title = $model->id_localizacao;
$this->params['breadcrumbs'][] = ['label' => 'Localizacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="localizacao-view">

    <p>
        <?= Html::a('Update', ['update', 'id_localizacao' => $model->id_localizacao], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_localizacao' => $model->id_localizacao], [
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
            'id_localizacao',
            'localizacao',
            'morada',
            'cod_postal',
        ],
    ]) ?>

</div>
