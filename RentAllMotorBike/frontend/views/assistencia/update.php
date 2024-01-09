<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Assistencia $model */

$this->title = 'Update Assistencia: ' . $model->id_assistencia;
$this->params['breadcrumbs'][] = ['label' => 'Assistencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_assistencia, 'url' => ['view', 'id_assistencia' => $model->id_assistencia]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="assistencia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
