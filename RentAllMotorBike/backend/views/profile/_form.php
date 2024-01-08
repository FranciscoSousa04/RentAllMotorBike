<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;



/** @var yii\web\View $this */
/** @var common\models\Profile $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apelido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telemovel')->textInput() ?>

    <?= $form->field($model, 'nif')->textInput() ?>

    <?= $form->field($model, 'nr_cartaconducao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['autocomplete' => 'off']) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'role')->dropdownList(['admin' => 'Admin', 'gestor' => 'Gestor de frota', 'cliente' => 'Cliente',],['prompt'=>'Seleciona a Role']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
