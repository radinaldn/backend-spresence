<?php

/* @var $this yii\web\View */

use app\models\KehadiranDosen;

$this->title = 'My Yii Application';
?>

<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="btn-group pull-right m-t-15">
            <button type="button" class="btn btn-custom dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Settings <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
            </ul>
        </div>
        <h4 class="page-title">Tahun Ajaran <?= $FindSemesterAktif->semester ?> <?= $FindSemesterAktif->tahun; ?></h4>
    </div>
</div>


<div class="row">
    <div class="col-lg-4">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </div>

            <h4 class="header-title m-t-0 m-b-30">Perkuliahan Hari Ini</h4>



            <div class="inbox-widget nicescroll" style="height: 315px; overflow: hidden; outline: none;" tabindex="5000">

                    <?php

                    foreach ($PresensiFindAllByDate as $kuliahHariIni){

                         ?>
                        <a href="<?= Yii::$app->getHomeUrl() ?>presensi-detail/histori-presensi-by-id-presensi?id=<?= $kuliahHariIni['id_presensi'] ?>">
                    <div class="inbox-item">
                        <div class="inbox-item-img"><img src="<?= Yii::$app->request->getBaseUrl()?>/files/images/dosen/<?= $kuliahHariIni['foto']?>" class="img-circle" alt=""></div>
                        <p class="inbox-item-author"><?= $kuliahHariIni['nama_dosen']; ?></p>
                        <p class="text-primary inbox-item-text">
                            <?= $kuliahHariIni['nama_matakuliah'] ?> (<?= $kuliahHariIni['kelas'] ?>)
                        </p>
                        <p class="inbox-item-content">Pertemuan ke
                            <b><?= $kuliahHariIni['pertemuan'] ?></b>
                        </p>
                        <p class="inbox-item-content"><i class="zmdi zmdi-pin"></i> <?= $kuliahHariIni['nama_ruangan'] ?>
                        </p>
                        <p class="text-danger inbox-item-content-right"><i class="fa fa-times-circle"></i> Tidak Hadir : <?= $kuliahHariIni['total_tidak_hadir'] ?>
                        <p class="text-success inbox-item-content-right"><i class="fa fa-check-circle"></i> Hadir : <?= $kuliahHariIni['total_hadir'] ?>
                        </p>
                        <p class="inbox-item-date"><i class="zmdi zmdi-time"></i> <?= $kuliahHariIni['waktu']; ?></p>
                    </div>

                        </a>
                    <?php }
                    ?>

            </div>

        </div>
    </div><!-- end col -->

    <div class="col-lg-8">
        <div class="card-box">
            <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="zmdi zmdi-more-vert"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </div>

            <h4 class="header-title m-t-0 m-b-30">Kehadiran Dosen</h4>

            <div class="table-responsive">
                <table id="example" class="table">



                    <thead>
                    <tr>

                        <th></th>
                        <th>Nip</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Lokasi</th>
                        <th>Last Update</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($KehadiranDosenFindAllDetail as $kehadiranDosen) { ?>
                    <tr>

                        <td><img height="50" width="50" class="img-circle user-img user-img" src="<?= Yii::$app->getHomeUrl() ?>files/images/dosen/<?= $kehadiranDosen['foto'] ?>" alt=""></td>
                        <td><?= $kehadiranDosen['nip'] ?></td>
                        <td><?= $kehadiranDosen['nama_dosen'] ?></td>
                        <td><?php
                            if ($kehadiranDosen['status_kehadiran'] == KehadiranDosen::HADIR){
                                echo "<span class=\"label label-success\">".$kehadiranDosen['status_kehadiran']."</span>";
                            } else {
                                echo "<span class=\"label label-danger\">".$kehadiranDosen['status_kehadiran']."</span>";
                            }
                            ?>
                        </td>
                        <td><?= $kehadiranDosen['nama_kota'] ?></td>
                        <td><?= $kehadiranDosen['last_update'] ?></td>
                    </tr>

                    <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- end col -->

</div>
