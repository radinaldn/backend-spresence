<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Presensi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="presensi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_presensi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_mengajar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_kelas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pertemuan')->dropDownList([ 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10', 11 => '11', 12 => '12', 13 => '13', 14 => '14', 15 => '15', 16 => '16', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'id_ruangan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'waktu')->textInput() ?>

    <?= $form->field($model, 'qr_code')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
