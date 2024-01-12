<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Detalhesaluguer $model */

$this->title = 'Create Detalhesaluguer';
$this->params['breadcrumbs'][] = ['label' => 'Detalhesaluguers',  'url' => ['/detalhesaluguer/index', 'id_user' => Yii::$app->user->getId()]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detalhesaluguer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dias'=>$dias,
    ]) ?>

</div>
