<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Seguro $model */

$this->title = 'Create Seguro';
$this->params['breadcrumbs'][] = ['label' => 'Seguros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seguro-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
