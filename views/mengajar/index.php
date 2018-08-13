<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MengajarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Perkuliahan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mengajar-index">


    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // echo Html::a('Create Mengajar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_mengajar',
            [
                'label'=>'Foto',
                'format'=>'raw',
                'value' => function($data){
                    $url = Yii::$app->getHomeUrl()."/files/images/dosen/".$data['foto'];
                    return Html::img($url,['alt'=>'yii', 'class'=>'img-circle user-img', 'height'=>'100', 'width'=>'100']);
                }
            ],
            'nip',
            'dosen',
            'matakuliah',
            'kelas',
            'hari',
            'waktu_mulai',
            'sks',
            'status',

            [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Action',
                    'headerOptions' => ['width' => '80'],
                    //'template' => '{view} {update} {delete} {link}',
                    'template' => '{semua-pertemuan}',
                    'buttons' => [
//                            'update' => function ($url,$model) {
//                                return Html::a(
//                                        '<i class="fa fa-user"></i>',
//                                            $url);
//                            },
                            'semua-pertemuan' => function ($url,$model,$key){
                                $url = Yii::$app->getHomeUrl().'presensi/histori-mengajar-by-id-mengajar?id='.$model['id_mengajar'];
                                return Html::a('<i class="ti-more-alt"></i>', $url,['title'=>'Lihat pertemuan']);
                            },
                    ],
            ],

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
