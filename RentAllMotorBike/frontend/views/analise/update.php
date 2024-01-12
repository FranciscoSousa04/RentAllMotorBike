<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Analise $model */

$this->title = 'Update Analise: ' . $model->id_analise;
$this->params['breadcrumbs'][] = ['label' => 'Analises', 'url' => ['/analise/index', 'id_user' => Yii::$app->user->getId()]];
$this->params['breadcrumbs'][] = ['label' => $model->id_analise, 'url' => ['view', 'id_analise' => $model->id_analise]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="analise-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
