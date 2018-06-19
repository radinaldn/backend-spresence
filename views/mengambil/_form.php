<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Mengambil */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mengambil-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_mengambil')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nim')->textInput() ?>

    <?= $form->field($model, 'id_mengajar')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
