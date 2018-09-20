<?php
/**
 * Created by PhpStorm.
 * User: radinaldn
 * Date: 12/08/18
 * Time: 22:04
 */


use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PresensiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$matakuliah = $modelMengajar->matakuliah->nama;
$dosen = $modelMengajar->nip0->nama;
$kelas = $modelMengajar->kelas->nama;
$foto = $modelMengajar->nip0->foto;

$this->title = $matakuliah." (".$kelas.") ";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presensi-index">

    <div class="row">
        <div class="col-sm-12">

            <div class="btn-group pull-left m-t-15">

                <a href="<?= Url::to(['mengajar/index']) ?>" class="btn btn-purple"> <i class="fa fa-arrow-left"></i> <span>Semua Perkuliahan</span> </a>
            </div>
            <div class="btn-group pull-right">
                <h4 class="page-title"><i class="fa fa-history"></i> Histori Pertemuan</h4>
            </div>
            <br>

        </div>
    </div>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="card-box">
        <div class="dropdown pull-right">
            <h4 class="header-title m-t-0 m-b-30 text-success">
                <img class="img-circle user-img" src="<?= Yii::$app->getHomeUrl() ?>files/images/dosen/<?= $foto ?>" width="50" height="50" alt="yii">
                <?= Html::encode($dosen) ?></h4>
        </div>


        <h4 class="header-title m-t-0 m-b-30 text-success"><?= Html::encode($this->title) ?></h4>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_presensi',
//            'nama_dosen',
//            'nama_matakuliah',
//            'kelas',
            [
                'format'=>'html',
                'attribute'=>'text',
                'label'=>'Pertemuan',
                'value'=>function($data){
                        return Html::decode(Html::decode('<a><span class="label label-default">Pertemuan '.$data['pertemuan'].'</span></a>'));
                },
            ],
            'nama_ruangan',
            'waktu',
            [
                'format'=>'html',
                'attribute'=>'text',
                'label'=>'Total Hadir',
                'value'=>function($data){
                    return Html::decode(Html::decode('<a><span class="label label-success">'.$data['total_hadir'].'</span></a>'));
                },
            ],
            [
                'format'=>'html',
                'attribute'=>'text',
                'label'=>'Total Tidak Hadir',
                'value'=>function($data){
                    return Html::decode(Html::decode('<a><span class="label label-danger">'.$data['total_tidak_hadir'].'</span></a>'));
                },
            ],

            [
                'format'=>'html',
                'attribute'=>'text',
                'label'=>'Status',
                'value'=>function($data){

                    switch ($data['status']){
                        case "open":
                            $url = Yii::$app->getHomeUrl()."/custom/assets/images/ic_on_proggres.png";
                            return Html::img($url,['alt'=>'yii', 'class'=>'img-circle user-img', 'height'=>'30', 'title'=>'Presensi open']);
                            break;
                        case "close":
                            $url = Yii::$app->getHomeUrl()."/custom/assets/images/ic_clear_green.png";
                            return Html::img($url,['alt'=>'yii', 'class'=>'img-circle user-img', 'height'=>'30', 'title'=>'Presensi closed']);
                            break;
                    }
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Aksi',
                'headerOptions' => ['width' => '80'],
                //'template' => '{view} {update} {delete} {link}',
                'template' => '{semua-pertemuan}',
                'buttons' => [

                    'semua-pertemuan' => function ($url,$model,$key){
                        $url = Yii::$app->getHomeUrl().'presensi-detail/histori-presensi-by-id-presensi?id='.$model['id_presensi'];
                        return Html::a('<i class="ti-more-alt"></i>', $url,['title'=>'Detail pertemuan-'.$model['pertemuan']]);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
