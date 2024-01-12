<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Localizacao $model */

$this->title = 'Create Localização';
$this->params['breadcrumbs'][] = ['label' => 'Localizacaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="localizacao-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
