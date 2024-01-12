<?php

use common\models\Localizacao;
use kartik\date\DatePicker;
use kartik\daterange\DateRangePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Detalhesaluguer $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="detalhesaluguer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($dias != null)
        echo 'Já existem datas reservadas, por favor selecione fora dos seguintes intervalos: ';
    foreach ($dias

    as $dia) { ?>
    <table>
        <?php
        echo ' <td>' . date_format(date_create($dia->data_inicio), "d-m-Y") . ' a ' . date_format(date_create($dia->data_fim), "d-m-Y");
        echo '</table>';
        //date_format($date,"Y/m/d H:i:s");
        } ?>

        <div class="row">
            <div class="col">
                <?= $form->field($model, 'data_inicio')->input('datetime-local'); ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'data_fim')->input('datetime-local'); ?>
            </div>
        </div>


        <?= $form->field($model, 'marca')->textInput(['value' => $model->motociclo->marca . " " . $model->motociclo->modelo, 'readonly' => true]); ?>

        <?= $form->field($model, 'profile')->textInput(['value' => Yii::$app->user->identity->username, 'readonly' => true]); ?>

        <?= $form->field($model, 'seguro_id')->dropDownList(ArrayHelper::map(\common\models\Seguro::find()->all(), 'id_seguro', 'cobertura'), ['prompt' => '']) ?>

        <?= $form->field($model, 'localizacao_levantamento_id')->dropDownList(ArrayHelper::map(Localizacao::find()->all(), 'id_localizacao', 'localizacao'), ['prompt' => '']) ?>

        <?= $form->field($model, 'localizacao_devolucao_id')->dropDownList(ArrayHelper::map(Localizacao::find()->all(), 'id_localizacao', 'localizacao'), ['prompt' => '']) ?>

        <?= $form->field($model, 'extras')->checkboxList(ArrayHelper::map(\common\models\Extra::find()->all(), 'id_extra', 'descricao')) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'name' => 'btnCriarDetalhesAluguer']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>
