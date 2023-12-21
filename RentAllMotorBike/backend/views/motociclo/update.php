<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Motociclo $model */

$this->title = 'Update Motociclo: ' . $model->idmotociclo;
$this->params['breadcrumbs'][] = ['label' => 'Motociclos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idmotociclo, 'url' => ['view', 'idmotociclo' => $model->idmotociclo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="motociclo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
