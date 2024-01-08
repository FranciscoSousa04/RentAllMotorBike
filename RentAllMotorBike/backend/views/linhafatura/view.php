<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\LinhaFatura $model */

$this->title = $model->id_linha_fatura;
$this->params['breadcrumbs'][] = ['label' => 'Linha Faturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="linha-fatura-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_linha_fatura' => $model->id_linha_fatura], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_linha_fatura' => $model->id_linha_fatura], [
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
            'id_linha_fatura',
            'descricao',
            'preco',
            'fatura_id',
        ],
    ]) ?>

</div>
