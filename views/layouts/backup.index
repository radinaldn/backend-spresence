<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\CustomAsset;

CustomAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>



<body class="fix-header fix-sidebar card-no-border">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">

    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar">

            <div class="navbar-collapse">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav mr-auto mt-md-0">
                    <!-- This is  -->
                    <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                    <!-- ============================================================== -->
                    <!-- Search -->
                    <!-- ============================================================== -->

                </ul>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <ul class="navbar-nav my-lg-0">
                    <!-- ============================================================== -->
                    <!-- Profile -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= Yii::$app->getHomeUrl() ?>custom/assets/images/users/1.jpg" alt="user" class="profile-pic m-r-10" /><a style="color: white">Markarn Doe</a></a>
                    </li>


                </ul>
            </div>

        </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li> <a class="waves-effect waves-dark" href="<?= Url::to(['home/index']); ?>" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Halaman Utama</span></a>
                    </li>
                    <li> <a class="waves-effect waves-dark" href="<?= Url::to(['matakuliah/index']); ?>" aria-expanded="false"><i class="mdi mdi-account-check"></i><span class="hide-menu">Matakuliah</span></a>
                    </li>
                    <li> <a class="waves-effect waves-dark" href="<?= Url::to(['mahasiswa/index']); ?>" aria-expanded="false"><i class="mdi mdi-table"></i><span class="hide-menu">Mahasiswa</span></a>
                    </li>
                    <li> <a class="waves-effect waves-dark" href="<?= Url::to(['dosen/index']); ?>" aria-expanded="false"><i class="mdi mdi-emoticon"></i><span class="hide-menu">Dosen</span></a>
                    </li>
                    <li> <a class="waves-effect waves-dark" href="<?= Url::to(['mengajar/index']); ?>" aria-expanded="false"><i class="mdi mdi-earth"></i><span class="hide-menu">Mengajar</span></a>
                    </li>
                    <li> <a class="waves-effect waves-dark" href="<?= Url::to(['mengambil/index']); ?>" aria-expanded="false"><i class="mdi mdi-book-open-variant"></i><span class="hide-menu">Mengambil</span></a>
                    </li>
                    <li> <a class="waves-effect waves-dark" href="<?= Url::to(['presensi/index']); ?>" aria-expanded="false"><i class="mdi mdi-book-open-variant"></i><span class="hide-menu">Presensi</span></a>
                    </li>
                    <li> <a class="waves-effect waves-dark" href="<?= Url::to(['presensi-detail/index']); ?>" aria-expanded="false"><i class="mdi mdi-book-open-variant"></i><span class="hide-menu">Presensi Detail</span></a>
                    </li>
                    <li> <a class="waves-effect waves-dark" href="<?= Url::to(['kelas/index']); ?>" aria-expanded="false"><i class="mdi mdi-book-open-variant"></i><span class="hide-menu">Kelas</span></a>
                    </li>
                    <li> <a class="waves-effect waves-dark" href="<?= Url::to(['ruangan/index']); ?>" aria-expanded="false"><i class="mdi mdi-book-open-variant"></i><span class="hide-menu">Ruangan</span></a>
                    </li>
                    <li> <a class="waves-effect waves-dark" href="<?= Url::to(['fakultas/index']); ?>" aria-expanded="false"><i class="mdi mdi-book-open-variant"></i><span class="hide-menu">Fakultas</span></a>
                    </li>
                    <li> <a class="waves-effect waves-dark" href="<?= Url::to(['jurusan/index']); ?>" aria-expanded="false"><i class="mdi mdi-book-open-variant"></i><span class="hide-menu">Jurusan</span></a>
                    </li>
                    <li> <a class="waves-effect waves-dark" href="<?= Url::to(['semester-aktif/index']); ?>" aria-expanded="false"><i class="mdi mdi-book-open-variant"></i><span class="hide-menu">Semester Aktif</span></a>
                    </li>
                    <li> <a class="waves-effect waves-dark" href="<?= Url::to(['site/logout']); ?>" aria-expanded="false"><i class="mdi mdi-help-circle"></i><span class="hide-menu">Keluar</span></a>
                    </li>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
        <!-- Bottom points-->
        <div class="sidebar-footer">
            <!-- item--><a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
            <!-- item--><a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
            <!-- item--><a href="" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a> </div>
        <!-- End Bottom points-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper" style="min-height: 548px;">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 col-8 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Smart Presence</h3>

                </div>

            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <!-- column -->
                <div class="col-lg-12">
                    <?= $content ?>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
