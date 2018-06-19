<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SemesterAktif */

$this->title = 'Create Semester Aktif';
$this->params['breadcrumbs'][] = ['label' => 'Semester Aktifs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="semester-aktif-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
