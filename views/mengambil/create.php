<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Mengambil */

$this->title = 'Create Mengambil';
$this->params['breadcrumbs'][] = ['label' => 'Mengambils', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mengambil-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
