<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Tipomotociclo $model */

$this->title = 'Create Tipo motociclo';
$this->params['breadcrumbs'][] = ['label' => 'Tipo motociclos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipomotociclo-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
