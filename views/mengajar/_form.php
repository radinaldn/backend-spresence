<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Mengajar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mengajar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_mengajar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_matakuliah')->textInput() ?>

    <?= $form->field($model, 'nip')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
