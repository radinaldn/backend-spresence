<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mengajar */

$this->title = 'Update Mengajar: ' . $model->id_mengajar;
$this->params['breadcrumbs'][] = ['label' => 'Mengajars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_mengajar, 'url' => ['view', 'id' => $model->id_mengajar]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mengajar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
