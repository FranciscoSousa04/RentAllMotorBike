<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Detalhesaluguer $model */

$this->title = 'Create Detalhesaluguer';
$this->params['breadcrumbs'][] = ['label' => 'Detalhesaluguers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detalhesaluguer-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
