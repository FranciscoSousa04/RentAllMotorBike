<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Localizacao $model */

$this->title = 'Update Localizacao: ' . $model->id_localizacao;
$this->params['breadcrumbs'][] = ['label' => 'Localizacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_localizacao, 'url' => ['view', 'id_localizacao' => $model->id_localizacao]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="localizacao-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
