<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mengambil */

$this->title = 'Update Mengambil: ' . $model->id_mengambil;
$this->params['breadcrumbs'][] = ['label' => 'Mengambils', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_mengambil, 'url' => ['view', 'id' => $model->id_mengambil]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mengambil-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
