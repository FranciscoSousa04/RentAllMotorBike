<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Extra $model */

$this->title = 'Create Extra';
$this->params['breadcrumbs'][] = ['label' => 'Extras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="extra-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
