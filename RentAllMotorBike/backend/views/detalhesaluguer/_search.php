<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\DetalhesaluguerSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="detalhesaluguer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_detalhes_aluguer') ?>

    <?= $form->field($model, 'data_inicio') ?>

    <?= $form->field($model, 'data_fim') ?>

    <?= $form->field($model, 'motociclo_id') ?>

    <?= $form->field($model, 'profile_id') ?>

    <?php // echo $form->field($model, 'seguro_id') ?>

    <?php // echo $form->field($model, 'localizacao_levantamento_id') ?>

    <?php // echo $form->field($model, 'localizacao_devolucao_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
