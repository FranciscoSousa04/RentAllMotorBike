<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\motociclo $model */

$this->title = 'Create motociclo';
$this->params['breadcrumbs'][] = ['label' => 'motociclos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="motociclo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
