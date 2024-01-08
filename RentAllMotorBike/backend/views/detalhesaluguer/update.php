<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Detalhesaluguer $model */

$this->title = 'Update Detalhesaluguer: ' . $model->id_detalhes_aluguer;
$this->params['breadcrumbs'][] = ['label' => 'Detalhesaluguers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_detalhes_aluguer, 'url' => ['view', 'id_detalhes_aluguer' => $model->id_detalhes_aluguer]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="detalhesaluguer-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
