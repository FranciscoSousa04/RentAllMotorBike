<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Registo';
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'nome')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'apelido') ?>

                <?= $form->field($model, 'telemovel')->textInput(['type' => 'number']) ?>

                <?= $form->field($model, 'nif')->textInput(['type' => 'number']) ?>

                <?= $form->field($model, 'cartaConducao') ?>

                <?= $form->field($model, 'username') ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    <p></p>
                    Já fez o registo? <?= Html::a('Login', ['site/login']) ?>

                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
