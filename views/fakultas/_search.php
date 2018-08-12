<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FakultasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fakultas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_fakultas') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'titik_a_lat') ?>

    <?= $form->field($model, 'titik_a_lng') ?>

    <?= $form->field($model, 'titik_b_lat') ?>

    <?php // echo $form->field($model, 'titik_b_lng') ?>

    <?php // echo $form->field($model, 'titik_c_lat') ?>

    <?php // echo $form->field($model, 'titik_c_lng') ?>

    <?php // echo $form->field($model, 'titik_d_lat') ?>

    <?php // echo $form->field($model, 'titik_d_lng') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
