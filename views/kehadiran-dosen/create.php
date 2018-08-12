<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\KehadiranDosen */

$this->title = 'Create Kehadiran Dosen';
$this->params['breadcrumbs'][] = ['label' => 'Kehadiran Dosens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kehadiran-dosen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
