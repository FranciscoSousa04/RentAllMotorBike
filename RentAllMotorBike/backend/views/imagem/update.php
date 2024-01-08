<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Imagem $model */

$this->title = 'Update Imagem: ' . $model->id_imagem;
$this->params['breadcrumbs'][] = ['label' => 'Imagems', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_imagem, 'url' => ['view', 'id_imagem' => $model->id_imagem]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="imagem-update">


    <?= $this->render('_form', [
        'model' => $model,
        'modelupload' => $modelupload,

    ]) ?>

</div>
