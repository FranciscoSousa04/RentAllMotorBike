<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Analise $model */

$this->title = 'Create Analise';
$this->params['breadcrumbs'][] = ['label' => 'Analises', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="analise-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
