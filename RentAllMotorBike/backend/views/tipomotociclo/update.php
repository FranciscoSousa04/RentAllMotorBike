<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Tipomotociclo $model */

$this->title = 'Update Tipo motociclo: ' . $model->id_tipo_motociclo;
$this->params['breadcrumbs'][] = ['label' => 'Tipo motociclos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_tipo_motociclo, 'url' => ['view', 'id_tipo_motociclo' => $model->id_tipo_motociclo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipomotociclo-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
