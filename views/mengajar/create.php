<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Mengajar */

$this->title = 'Create Mengajar';
$this->params['breadcrumbs'][] = ['label' => 'Mengajars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mengajar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
