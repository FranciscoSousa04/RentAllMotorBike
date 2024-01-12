<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\motocicloSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="motociclo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idmotociclo') ?>

    <?= $form->field($model, 'marca') ?>

    <?= $form->field($model, 'modelo') ?>

    <?= $form->field($model, 'descricao') ?>

    <?= $form->field($model, 'combustivel') ?>

    <?php // echo $form->field($model, 'preco') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'tipo_motociclo_id') ?>

    <?php // echo $form->field($model, 'localizacao_id') ?>

    <?php // echo $form->field($model, 'franquia') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
