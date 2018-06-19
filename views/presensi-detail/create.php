<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PresensiDetail */

$this->title = 'Create Presensi Detail';
$this->params['breadcrumbs'][] = ['label' => 'Presensi Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presensi-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
