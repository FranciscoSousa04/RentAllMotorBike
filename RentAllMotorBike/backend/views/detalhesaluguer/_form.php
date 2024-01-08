<?php

use common\models\Localizacao;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Detalhesaluguer $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="detalhesaluguer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    DatePicker::widget([
        'model' => $model,
        'attribute' => 'data_inicio',
        'attribute2' => 'data_fim',
        'options' => ['placeholder' => 'Data de inicio'],
        'options2' => ['placeholder' => 'Data de fim'],
        'type' => DatePicker::TYPE_RANGE,
        'form' => $form,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
        ]
    ])
    ?>

    <?= $form->field($model, 'motociclo')->textInput(['value' => $model->motociclo->marca . " " . $model->motociclo->modelo, 'readonly' => true]); ?>

    <?= $form->field($model, 'profile')->textInput(['value' => Yii::$app->user->identity->username, 'readonly' => true]); ?>

    <?= $form->field($model, 'seguro_id')->dropDownList(ArrayHelper::map(\common\models\Seguro::find()->all(), 'id_seguro', 'cobertura'), ['prompt' => '']) ?>

    <?= $form->field($model, 'localizacao_levantamento_id')->dropDownList(ArrayHelper::map(Localizacao::find()->all(), 'id_localizacao', 'localizacao'), ['prompt' => '']) ?>

    <?= $form->field($model, 'localizacao_devolucao_id')->dropDownList(ArrayHelper::map(Localizacao::find()->all(), 'id_localizacao', 'localizacao'), ['prompt' => '']) ?>

    <?= $form->field($model, 'extras')->checkboxList(ArrayHelper::map(\common\models\Extra::find()->all(), 'id_extra', 'descricao')) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
