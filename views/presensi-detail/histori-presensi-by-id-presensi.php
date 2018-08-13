<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PresensiDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Presensi Mahasiswa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presensi-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([

        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_presensi',
            [
                'label'=>'Foto',
                'format'=>'raw',
                'value' => function($data){
                    $url = Yii::$app->getHomeUrl()."/files/images/mahasiswa/".$data['foto'];
                    return Html::img($url,['alt'=>'yii', 'class'=>'img-circle user-img', 'height'=>'100', 'width'=>'100']);
                }
            ],
            'nim',
            'nama_mahasiswa',
            'status',
            'waktu',
            'jarak',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
