<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ProfileSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_profile') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'apelido') ?>

    <?= $form->field($model, 'telemovel') ?>

    <?= $form->field($model, 'nif') ?>

    <?php // echo $form->field($model, 'nr_cartaconducao') ?>

    <?php // echo $form->field($model, 'idUser') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
