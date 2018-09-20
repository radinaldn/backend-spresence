<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PresensiDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$matakuliah = $modelPresensi->mengajar->matakuliah->nama;
$dosen = $modelPresensi->mengajar->nip0->nama;
$pertemuan = $modelPresensi->pertemuan;
$kelas = $modelPresensi->mengajar->kelas->nama;
$foto = $modelPresensi->mengajar->nip0->foto;

$this->title = $matakuliah." (".$kelas.") ";
$subtitle = "(Pertemuan ke-".$pertemuan.")";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presensi-detail-index">

    <div class="row">
        <div class="col-sm-12">

            <div class="btn-group pull-left m-t-15">

                <a href="<?= Url::to(['presensi/histori-mengajar-by-id-mengajar?id=']) ?><?= $modelPresensi->id_mengajar?>" class="btn btn-purple"> <i class="fa fa-arrow-left"></i> <span>Histori Pertemuan</span> </a>
            </div>
            <div class="btn-group pull-right">
                <h4 class="page-title"><i class="fa fa-list-alt"></i> Daftar Mahasiswa</h4>
            </div>
            <br>

        </div>
    </div>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

<div class="card-box">
    <div class="dropdown pull-right">


<!--        <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">-->
<!--            <i class="zmdi zmdi-more-vert"></i>-->
<!--        </a>-->
<!--        <ul class="dropdown-menu" role="menu">-->
<!--            <li><a href="#">Tampilkan QR Code</a></li>-->
<!--            <li class="divider"></li>-->
<!--            <li><a href="#">Separated link</a></li>-->
        </ul>
    </div>

    <div class="dropdown pull-right">
        <h4 class="header-title m-t-0 m-b-30 text-success">
            <img class="img-circle user-img" src="<?= Yii::$app->getHomeUrl() ?>files/images/dosen/<?= $foto ?>" width="50" height="50" alt="yii">
            <?= Html::encode($dosen) ?></h4>
    </div>


    <h4 class="header-title m-t-0 m-b-30 text-success"><a title="Lihat QR CODE" href="#show-qrcode-modal"
                                                          data-animation="fadein" data-plugin="custommodal"
                                                          data-overlaySpeed="200" data-overlayColor="#36404a">
            <img class="user-img" src="<?= Yii::$app->getHomeUrl() ?>files/qrcode/<?= $modelPresensi->qr_code ?>" width="50" height="50" alt="yii">
        </a> <?= Html::encode($this->title) ?><br><?= Html::encode($subtitle) ?>

        <?php
        $homeUrl = Yii::$app->getHomeUrl();
        switch ($modelPresensi->status){

            case "open":
                echo "<img title='Status presensi : open\n(QR CODE berlaku)' src='$homeUrl./custom/assets/images/ic_on_proggres.png' height='30px'> </h4>";
                break;
            case "close":
                echo "<img title='Status presensi : close\n(QR CODE kadaluwarsa)' src='$homeUrl./custom/assets/images/ic_clear_green.png' height='30px'> </h4>";
                break;
        }
        ?>



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
                    return Html::img($url,['alt'=>'yii', 'class'=>'img-circle user-img', 'height'=>'50', 'width'=>'50']);
                }
            ],
            'nim',
            'nama_mahasiswa',
            [
                'format'=>'html',
                'attribute'=>'text',
                'label'=>'Status',
                'value'=>function($data){

                    $status = $data['status'];

                    // jika kategori hijau
                    switch ($status){
                        case "Hadir":
                            return Html::decode(Html::decode('<a><span class="label label-success">'.$status.'</span></a>'));
                            break;
                        case "Tidak Hadir":
                            return Html::decode(Html::decode('<a><span class="label label-danger">'.$status.'</span></a>'));
                            break;
                    }
                },
            ],
            'waktu',
            [
                'format'=>'html',
                'attribute'=>'text',
                'label'=>'Jarak',
                'value'=>function($data){

                    $jarak = $data['jarak'];

                    // jika kategori hijau
                    if ($jarak > 0 && $jarak <=50){
                        return Html::decode(Html::decode('<a><span class="label label-success">'.$data['jarak'].' Meter</span></a>'));
                    } else if ($jarak > 50 && $jarak <=100){
                        return Html::decode(Html::decode('<a><span class="label label-warning">'.$data['jarak'].' Meter</span></a>'));
                    } else if ($jarak > 100) {
                        return Html::decode(Html::decode('<a><span class="label label-danger">'.$data['jarak'].' Meter</span></a>'));
                    } else {
                        return Html::decode(Html::decode('<a><span class="label label-default">'.$data['jarak'].' Meter</span></a>'));
                    }
                },
            ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
</div>

<!-- Modal -->
<div id="show-qrcode-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">QR CODE</h4>
    <div class="custom-modal-text">
        <?= $matakuliah ?> (<?= $kelas ?>) <a class="text-purple">Pertemuan ke-<?= $pertemuan ?></a>
    </div>
    <img src="<?= Yii::$app->getHomeUrl() ?>files/qrcode/<?= $modelPresensi->qr_code ?>">
    <div class="custom-modal-text">
        <?php
        switch ($modelPresensi->status){
            case "open":
                echo "<a><span class=\"label label-success\">Berlaku</span></a>";
                break;
            case "close":
                echo "<a><span class=\"label label-danger\">Kadaluwarsa</span></a>";
                break;
        }
        ?>
    </div>

</div>

