<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Assistencia $model */

$this->title = 'Create Assistencia';
$this->params['breadcrumbs'][] = ['label' => 'Assistencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assistencia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
