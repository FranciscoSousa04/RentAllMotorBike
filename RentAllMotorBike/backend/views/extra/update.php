<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Extra $model */

$this->title = 'Update Extra: ' . $model->id_extra;
$this->params['breadcrumbs'][] = ['label' => 'Extras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_extra, 'url' => ['view', 'id_extra' => $model->id_extra]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="extra-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
