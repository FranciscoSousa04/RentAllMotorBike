<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\LinhaFatura $model */

$this->title = 'Update Linha Fatura: ' . $model->id_linha_fatura;
$this->params['breadcrumbs'][] = ['label' => 'Linha Faturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_linha_fatura, 'url' => ['view', 'id_linha_fatura' => $model->id_linha_fatura]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="linha-fatura-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
