<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Fakultas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fakultas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'titik_a_lat')->textInput() ?>

    <?= $form->field($model, 'titik_a_lng')->textInput() ?>

    <?= $form->field($model, 'titik_b_lat')->textInput() ?>

    <?= $form->field($model, 'titik_b_lng')->textInput() ?>

    <?= $form->field($model, 'titik_c_lat')->textInput() ?>

    <?= $form->field($model, 'titik_c_lng')->textInput() ?>

    <?= $form->field($model, 'titik_d_lat')->textInput() ?>

    <?= $form->field($model, 'titik_d_lng')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
