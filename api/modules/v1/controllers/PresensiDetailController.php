<?php
/**
 * Created by PhpStorm.
 * User: radinaldn
 * Date: 19/06/18
 * Time: 16:09
 */

namespace app\api\modules\v1\controllers;

use app\models\BarcodeQR;
use app\models\Mahasiswa;
use app\models\Mengambil;
use app\models\Presensi;
use app\models\PresensiDetail;
use Pusher\Pusher;
use Yii;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;

class PresensiDetailController extends Controller
{
    /*
     * fungsi mahasiswa mengentri data presensi berdasarkan matakuliah, dosen pengajar, pertemuan
     */
    public function actionAdd(){
        Yii::$app->timeZone = 'Asia/Jakarta';
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isPost){
            $data = Yii::$app->request->post();

            $presensi_mahasiswa = PresensiDetail::find()
                                ->where(['id_presensi' => $data['id_presensi']])
                                ->andWhere(['nim' => $data['nim'] ])
                                ->one();

            $mengambil_matkul = Mengambil::find()
                ->innerJoinWith('mengajar')
                ->innerJoinWith('mengajar.tbPresensis')
                ->where(['tb_presensi.id_presensi' => $data['id_presensi']])
                ->andWhere(['nim' => $data['nim'] ])
                ->one();


            // jika mahasiswa belum presensi dan benar-benar mengambil matkul
            if ($presensi_mahasiswa==null && $mengambil_matkul!=null){
                $model = new PresensiDetail();

                $model->id_presensi = $data['id_presensi'];
                $model->nim = $data['nim'];
                $model->status = "hadir";
                $model->lat = $data['lat'];
                $model->lng= $data['lng'];
                $model->waktu = date('Y-m-d H:i:s');
                $model->jarak = $data['jarak'];
                $model->proses = "pending";

                // check
                $presensi = Presensi::findOne($model->id_presensi);

                if ($presensi==null){
                    $response['code'] = '404';
                    $response['status'] = 'Failed';
                    $response['message'] = 'Not found';
                } else if ($presensi->status == "open"){
                    if ($model->save()){
                        $response['code'] = '200';
                        $response['status'] = 'OK';
                        $response['message'] = 'Presensi success';
                    } else {
                        $response['status'] = 'Failed';
                    }
                } else {
                    $response['code'] = '403';
                    $response['status'] = 'Forbidden';
                    $response['message'] = 'Presensi closed';
                }
                // jika mahasiswa tidak mengambil matakuliah
            } else if ($mengambil_matkul==null) {
                $response['code'] = '403';
                $response['status'] = 'Forbidden';
                $response['message'] = 'Tidak terdaftar di matakuliah ini';
                // jika mahasiswa sudah presensi
            } else {
                $response['code'] = '500';
                $response['status'] = 'Error';
            }
        }

        return $response;
    }

//    Functoin untuk mengisi data presensi
    public function actionIsiPresensi(){
        Yii::$app->timeZone = 'Asia/Jakarta';
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isPost) {

            $data = Yii::$app->request->post();

            $ID_PRESENSI = $data['id_presensi'];
            $NIM = $data['nim'];
            $STATUS = "Hadir";
            $LAT = $data['lat'];
            $LNG = $data['lng'];
            $WAKTU = date("Y-m-d H:i:s");
            $JARAK = $data['jarak'];
            $PROSES = "Pending";

            /*
             * 1. Cek apakah Presensi::find($id_presensi) == null?
             */

            $presensi = Presensi::find()
                    ->where(['id_presensi' => $ID_PRESENSI])
                    ->one();

            if ($presensi==null){
                $response['code'] = '404';
                $response['status'] = 'Failed';
                $response['message'] = 'Presensi yang dituju tidak ditemukan';
            } else {

                /*
                 * 2. Cek apakah $presensi->status == "close" ?
                 */

                if($presensi->status == "close"){
                    $response['code'] = '403';
                    $response['status'] = 'Forbidden';
                    $response['message'] = 'Presensi sudah ditutup';
                } else {

                    /*
                     * 3. Temukan data PresensiDetail::find()->where(['id_presensi' => $ID_PRESENSI])->andWhere(['nim' => $NIM])
                     * cek apakah null ?
                     */

                    $presensi_detail = PresensiDetail::find()
                                        ->where(['id_presensi' => $ID_PRESENSI])
                                        ->andWhere(['nim' => $NIM])
                                        ->one();

                    if($presensi_detail==null){
                        $response['code'] = '403';
                        $response['status'] = 'Not registered';
                        $response['message'] = 'Anda tidak terdaftar di matakuliah ini';
                    } else {

                        /*
                         * Cek apakah $presensi_detail->status == "Hadir" ?
                         */

                        if ($presensi_detail->status == "Hadir"){
                            $response['code'] = '403';
                            $response['status'] = 'Already';
                            $response['message'] = 'Presensi sudah dilakukan sebelumnya';
                        } else {

                            /*
                             * Selamat, anda lolos melewati berbagai filter dan data presensi di entry di sini
                             */

                            $presensi_detail->status = $STATUS;
                            $presensi_detail->lat = $LAT;
                            $presensi_detail->lng= $LNG;
                            $presensi_detail->waktu = $WAKTU;
                            $presensi_detail->jarak = $JARAK;
                            $presensi_detail->proses = $PROSES;

                            if ($presensi_detail->update(false)){
                                $response['code'] = '200';
                                $response['status'] = 'OK';
                                $response['message'] = 'Presensi berhasil dilakukan';
                            } else {

                                /*
                                 * Ouh tidak sesuatu yg buruk telah terjadi
                                 */

                                $response['code'] = '500';
                                $response['status'] = 'Error';
                                $response['message'] = var_dump($presensi_detail);
                            }
                        }
                    }
                }
            }


        }
        return $response;


    }

    /*
     * fungsi menampilkan data presensi mahasiswa berdasarkan inputan ID Presensi
     */
    public function actionFindAllMahasiswaByIdPresensi($id_presensi){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if (Yii::$app->request->isGet){
            $model = PresensiDetail::find()
                    ->where(['id_presensi' => $id_presensi])
                    ->orderBy(['waktu' => SORT_DESC])
                    ->all();


            $sql = "SELECT tb_presensi_detail.id_presensi, tb_presensi_detail.nim, 
                    tb_mahasiswa.nama as nama_mahasiswa, tb_presensi_detail.status, 
                    tb_presensi_detail.lat, tb_presensi_detail.lng, DATE_FORMAT(tb_presensi_detail.waktu, '%d %b %Y %T') as waktu, 
                    tb_presensi_detail.jarak, tb_presensi_detail.proses
                    FROM tb_presensi_detail INNER JOIN tb_mahasiswa
                    WHERE tb_presensi_detail.nim = tb_mahasiswa.nim
                    AND tb_presensi_detail.id_presensi = '$id_presensi'
                    ORDER BY tb_presensi_detail.waktu DESC";

            $response['master'] = Yii::$app->db->createCommand($sql)->queryAll();
        }

        return $response;
    }

    public function actionFindAllMahasiswaByIdPresensiAndStatusKehadiran($id_presensi, $status_kehadiran){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if (Yii::$app->request->isGet){
            $sql = "SELECT tb_presensi_detail.id_presensi, tb_presensi_detail.nim, 
                    tb_mahasiswa.nama as nama_mahasiswa, tb_mahasiswa.foto as foto_mahasiswa, tb_presensi_detail.status, 
                    tb_presensi_detail.lat, tb_presensi_detail.lng, DATE_FORMAT(tb_presensi_detail.waktu, '%d %b %Y %T') as waktu, 
                    tb_presensi_detail.jarak, tb_presensi_detail.proses
                    FROM tb_presensi_detail INNER JOIN tb_mahasiswa
                    WHERE tb_presensi_detail.nim = tb_mahasiswa.nim
                    AND tb_presensi_detail.id_presensi = '$id_presensi'
                    AND tb_presensi_detail.status = '$status_kehadiran'
                    ORDER BY tb_presensi_detail.waktu DESC";

            $response['master'] = Yii::$app->db->createCommand($sql)->queryAll();
        }

        return $response;
    }

    /*
     * fungsi yang digunakan Dosen saat memvalidasi presensi pertemuan saat ini (MASIH BUG)
     */
    public function actionKonfirmasiAll(){
        Yii::$app->timeZone = 'Asia/Jakarta';
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if (Yii::$app->request->isPost){
            $data = Yii::$app->request->post();

            $ID_PRESENSI = $data['id_presensi'];
            $OK = PresensiDetail::OK;
            $TIDAK_HADIR = PresensiDetail::TIDAK_HADIR;

            // tutup presensi by id_presensi
            self::tutupPresensi($ID_PRESENSI);

            // get all data mahasiswa yang akan dikonfirmasi
            $model = PresensiDetail::find()
                    ->where(['id_presensi' => $ID_PRESENSI])
                    ->orderBy(['waktu' => SORT_DESC])
                    ->all();

            // update value proses from "pending" to "OK"
            foreach ($model as $presensi_detail){
                $presensi_detail->proses = $OK;
                $presensi_detail->waktu = $presensi_detail->waktu;

                $presensi_detail->update(false);


                // tambah poin ketidakhadiran kepada mahasiswa yang tidak hadir
                if ($presensi_detail->status == $TIDAK_HADIR){
                    //get data from tb_mengambil
                    $mahasiswa_mengambil = Mengambil::find()
                        ->innerJoinWith('mengajar')
                        ->innerJoinWith('mengajar.tbPresensis')
                        ->where(['tb_presensi.id_presensi' => $ID_PRESENSI])
                        ->andWhere(['nim' => $presensi_detail->nim ])
                        ->one();

                    $mahasiswa_mengambil->jumlah_ketidakhadiran += 1;
                    $mahasiswa_mengambil->update(false);
                }
            }

            if ($model==null){
                $response['code'] = '404';
                $response['status'] = 'Failed';
                $response['message'] = 'Not found';
            } else {

                $response['code'] = '200';
                $response['status'] = 'OK';
                $response['message'] = 'Konfirmasi success, presensi closed';

                /*
            send alert to mahasiswa yang tak di kelas */
                $target_alerts = Mahasiswa::findAllHabisJatahByIdPresensi($ID_PRESENSI);

                $secret_token = "bot606384723:AAEp6gO3gBl8V-FIxvfVClqBobmT5rvz35Q";

                foreach ($target_alerts as $target_alert){
                    $message_text = "Informasi Ketidakhadiran".PHP_EOL.PHP_EOL.
                        "Mohon maaf ".$target_alert['nama'].",".PHP_EOL.
                        "anda sudah ".$target_alert['jumlah_ketidakhadiran']."x tidak hadir di perkuliahan ".$target_alert['nama_matakuliah'].".".PHP_EOL.
                        "Bila tidak hadir hingga 4x, maka anda tidak diperkenankan mengikuti UAS.";

                    $id_telegram = $target_alert['id_telegram'];
                    Mahasiswa::sendAlertKetidakhadiran($id_telegram, $message_text, $secret_token);

                }
                $response['telegram'] = 'Alert delivered';

                /*
                end of send  return $response; alert*/

            }

        }

        return $response;
    }

    public static function tutupPresensi($id_presensi){
        $presensi = Presensi::findOne($id_presensi);
        $presensi->status = "close";
        $presensi->update(false);

        $options = array(
            'cluster' => 'ap1',
            'encrypted' => true
        );

        $pusher = new Pusher(
            'bc60d7c1c853ac34dde4',
            'd90ef6759c185d9bdbf2',
            '539066',
            $options
        );

        //$pusher->trigger('my-channel', 'my-event', 'app.presensiFindAllToday();');
        $pusher->trigger('my-channel', 'my-event', [
            'table'=>'app.presensiFindAllToday();',
            'dosen' => $presensi->mengajar->nip0->nama,
            'matakuliah' => $presensi->mengajar->matakuliah->nama,
            'kelas' => $presensi->mengajar->kelas->nama,
            'pertemuan' => $presensi->pertemuan,
            'ruangan' => $presensi->ruangan->nama
        ]);
    }

    /*
     * fungsi yang digunakan mahasiswa untuk melihat histori presensi berdasarkan inputan Nim dan Tanggal
     */
    public function actionHistoriPresensiByNimAndDate($nim, $date){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isGet){
            $sql = "SELECT tb_presensi_detail.id_presensi, tb_presensi_detail.nim, DATE_FORMAT(tb_presensi_detail.waktu, '%d %b %Y %T') as waktu, tb_presensi_detail.status, 
                    tb_presensi.pertemuan, tb_ruangan.nama as nama_ruangan, tb_kelas.nama as nama_kelas, tb_matakuliah.nama as nama_matakuliah,
                    tb_dosen.nama as nama_dosen FROM tb_presensi_detail 
                    INNER JOIN tb_presensi, tb_mengajar, tb_matakuliah, tb_dosen, tb_ruangan, tb_kelas 
                    WHERE tb_presensi_detail.id_presensi = tb_presensi.id_presensi 
                    AND tb_presensi.id_mengajar = tb_mengajar.id_mengajar 
                    AND tb_mengajar.id_matakuliah = tb_matakuliah.id_matakuliah 
                    AND tb_mengajar.nip = tb_dosen.nip 
                    AND tb_presensi.id_ruangan = tb_ruangan.id_ruangan
                    AND tb_mengajar.id_kelas = tb_kelas.id_kelas
                    AND tb_presensi_detail.nim = '$nim' 
                    AND date(tb_presensi_detail.waktu) = '$date'";

            $response['master'] = Yii::$app->db->createCommand($sql)->queryAll();
        }

        return $response;
    }

    /*
     * fungsi yang digunakan Dosen untuk membatalkan presensi mahasiswa (misal: karna terdeteksi melakukan kecurangan)
     */
    public function actionBatalkanPresensi(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if (Yii::$app->request->isPost){
            $data = Yii::$app->request->post();

            $id_presensi = $data['id_presensi'];
            $nim = $data['nim'];

            $model = PresensiDetail::find()
                    ->where(['id_presensi' => $id_presensi])
                    ->andWhere(['nim' => $nim])
                    ->one();

            $model->status = "Tidak Hadir";
            $model->update(false);

            $response['code'] = "200";
            $response['status'] = "OK";
            $response['message'] = "Presensi ".$model->nim0->nama." berhasil dibatalkan";
        }

        return $response;
    }

    /***
     * @return null
     * fungsi untuk merubah status presensi menjadi Tidak Hadir dan Menambah jumlah ketidakhadiran
     */

    public function actionBatalkanPresensiDanTambahTidakHadir(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if (Yii::$app->request->isPost){
            $data = Yii::$app->request->post();

            $id_presensi = $data['id_presensi'];
            $nim = $data['nim'];

            $model = PresensiDetail::find()
                ->where(['id_presensi' => $id_presensi])
                ->andWhere(['nim' => $nim])
                ->one();

            $model->status = "Tidak Hadir";
            $model->update(false);

            $jatah = Mengambil::find()
                ->innerJoinWith('mengajar')
                ->innerJoinWith('mengajar.tbPresensis')
                ->where(['tb_presensi.id_presensi' => $id_presensi])
                ->andWhere(['nim' => $nim ])
                ->one();

            $jatah->jumlah_ketidakhadiran++;
            $jatah->update(false);

            $response['code'] = "200";
            $response['status'] = "OK";
            $response['message'] = "Presensi ".$model->nim0->nama." berhasil dibatalkan dan poin ketidakhadiran berhasil ditambah";
        }

        return $response;
    }

    public function actionTerimaPresensi(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if (Yii::$app->request->isPost){
            $data = Yii::$app->request->post();

            $id_presensi = $data['id_presensi'];
            $nim = $data['nim'];

            $model = PresensiDetail::find()
                ->where(['id_presensi' => $id_presensi])
                ->andWhere(['nim' => $nim])
                ->one();

            $model->status = "Hadir";
            $model->update(false);

            $response['code'] = "200";
            $response['status'] = "OK";
            $response['message'] = "Presensi ".$model->nim0->nama." berhasil diterima";
        }

        return $response;
    }

    /**
     * @return null
     * fungsi untuk merubah status presensi menjadi Hadir dan Mengurangi poin ketidak hadiran
     */
    public function actionTerimaPresensiDanKurangiTidakHadir(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if (Yii::$app->request->isPost){
            $data = Yii::$app->request->post();

            $id_presensi = $data['id_presensi'];
            $nim = $data['nim'];

            $model = PresensiDetail::find()
                ->where(['id_presensi' => $id_presensi])
                ->andWhere(['nim' => $nim])
                ->one();

            $model->status = "Hadir";
            $model->update(false);

            $jatah = Mengambil::find()
                ->innerJoinWith('mengajar')
                ->innerJoinWith('mengajar.tbPresensis')
                ->where(['tb_presensi.id_presensi' => $id_presensi])
                ->andWhere(['nim' => $nim ])
                ->one();

            $jatah->jumlah_ketidakhadiran--;
            $jatah->update(false);

            $response['code'] = "200";
            $response['status'] = "OK";
            $response['message'] = "Presensi ".$model->nim0->nama." berhasil diterima dan poin ketidakhadiran berhasil dikurangi";
        }

        return $response;
    }

    public function actionDelete($id_presensi, $nim){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if (Yii::$app->request->isGet) {
            $model = PresensiDetail::find()
                    ->where(['id_presensi' => $id_presensi])
                    ->andWhere(['nim' => $nim])
                    ->one();

            $model->delete();

            $response['code'] = '200';
            $response['status'] = 'OK';
            $response['message'] = 'Deleted';
        }

        return $response;
    }

    /*
     * ini fungsi DUMMY (testing)
     */
    public function actionTest($id_presensi){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if (Yii::$app->request->isGet) {
            $qr = new BarcodeQR();
            $qr_content = "test";

            // create URL QR Code
            $qr->text($qr_content);

            $qr->draw(200, Yii::$app->getBasePath()."/web/files/qrcode/".$qr_content.".png");
        }

        return $response;
    }

    /*
     * fungsi untuk mendapatkan histori perkuliahan berdasarkan inputan nim dan tanggal
     */
    public function actionFindByNimAndDate($nim, $date){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if (Yii::$app->request->isGet){
            $sql = "SELECT tb_presensi_detail.id_presensi, tb_presensi_detail.nim, 
                    tb_mahasiswa.nama as nama_mahasiswa, tb_presensi_detail.status, 
                    DATE_FORMAT(tb_presensi_detail.waktu, '%d %b %Y %T') as waktu, tb_matakuliah.nama as nama_matakuliah, 
                    tb_dosen.nama as nama_dosen, tb_kelas.nama as nama_kelas, tb_presensi.pertemuan, 
                    tb_ruangan.nama as nama_ruangan 
                    FROM tb_presensi_detail INNER JOIN tb_mahasiswa, 
                    tb_presensi, tb_mengajar, tb_matakuliah, tb_dosen, tb_kelas, tb_ruangan 
                    WHERE tb_presensi_detail.id_presensi = tb_presensi.id_presensi 
                    AND tb_presensi_detail.nim = tb_mahasiswa.nim 
                    AND tb_presensi.id_mengajar = tb_mengajar.id_mengajar
                    AND tb_mengajar.id_matakuliah = tb_matakuliah.id_matakuliah 
                    AND tb_mengajar.nip = tb_dosen.nip 
                    AND tb_mengajar.id_kelas = tb_kelas.id_kelas 
                    AND tb_presensi.id_ruangan = tb_ruangan.id_ruangan 
                    AND tb_presensi_detail.nim = '$nim' 
                    AND DATE_FORMAT(tb_presensi_detail.waktu, '%Y-%m-%d') = '$date'
                    ORDER BY tb_presensi_detail.waktu DESC";

            $response['master'] = Yii::$app->db->createCommand($sql)->queryAll();
        }

        return $response;
    }
}