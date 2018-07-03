<?php
/**
 * Created by PhpStorm.
 * User: radinaldn
 * Date: 19/06/18
 * Time: 16:09
 */

namespace app\api\modules\v1\controllers;

use app\models\Mahasiswa;
use app\models\Mengambil;
use app\models\Presensi;
use app\models\PresensiDetail;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class PresensiDetailController extends Controller
{
    /*
     * fungsi mahasiswa mengentri data presensi berdasarkan matakuliah, dosen pengajar, pertemuan
     */
    public function actionAdd(){
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
                $response['code'] = '403';
                $response['status'] = 'Forbidden';
                $response['message'] = 'Presensi telah dilakukan';
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

            $response['master'] = $model;
        }

        return $response;
    }

    /*
     * fungsi yang digunakan Dosen saat memvalidasi presensi pertemuan saat ini (MASIH BUG)
     */
    public function actionKonfirmasiAll(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if (Yii::$app->request->isPost){
            $data = Yii::$app->request->post();

            $id_presensi = $data['id_presensi'];

            // get all data mahasiswa yang akan dikonfirmasi
            $model = PresensiDetail::find()
                    ->where(['id_presensi' => $id_presensi])
                    ->orderBy(['waktu' => SORT_DESC])
                    ->all();



            // update value proses from "pending" to "OK"
            foreach ($model as $presensi_detail){
                $presensi_detail->proses = "OK";
                $presensi_detail->update(false);
            }

            // get mahasiswa mengambil matakuliah dengan dosen tersebut
            $sql_mengambil = "SELECT tb_mengambil.id_mengambil, tb_mengambil.nim, tb_mengajar.id_mengajar, tb_presensi.id_presensi 
                              FROM tb_mengambil INNER JOIN tb_mengajar, tb_presensi 
                              WHERE tb_mengambil.id_mengajar = tb_mengajar.id_mengajar 
                              AND tb_mengajar.id_mengajar = tb_presensi.id_mengajar 
                              AND tb_presensi.id_presensi = '$id_presensi'";

            $model_mengambil = Yii::$app->db->createCommand($sql_mengambil)->queryAll();

            /* ini masih BUG
            */

//            var_dump($model_mengambil);
//            exit();

            foreach ($model_mengambil as $mengambil){ // ada 4 orang yg ngambil
                $trigger = true;
                foreach ($model as $presensi_detail) { // ada 1 orang yg presensi

                    //if (isset($presensi_detail->nim)) { // kalau ini dikomenkan error "Tryin to get property of non object"
                    if ($mengambil['nim'] == $presensi_detail->nim && $presensi_detail->id_presensi == $id_presensi) {
                        $trigger = false;

                    }
                    //}
                }

                // simpan data mahasiswa yang tidak hadir disini
                if ($trigger==true){
                    $model = new PresensiDetail();
                    $model->id_presensi = $id_presensi;
                    $model->nim = $mengambil['nim'];
//                  echo "<br>";
                    $model->status = "Tidak Hadir";
                    $model->lat = 0;
                    $model->lng = 0;
                    $model->waktu = date('Y-m-d H:i:s');
                    $model->jarak = 0;
                    $model->proses = "OK";
                    $model->save();

                     //get data from tb_mengambil
                    $mahasiswa_mengambil = Mengambil::find()
                        ->innerJoinWith('mengajar')
                        ->innerJoinWith('mengajar.tbPresensis')
                        ->where(['tb_presensi.id_presensi' => $model->id_presensi])
                        ->andWhere(['nim' => $model->nim ])
                        ->one();

                    $mahasiswa_mengambil->jumlah_ketidakhadiran += 1;
                    $mahasiswa_mengambil->update(false);

                }
            }

            /*
            send alert to mahasiswa pemalas */
            $target_alerts = Mahasiswa::findAllHabisJatahByIdPresensi($id_presensi);

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
            end of send alert*/

            if ($model==null){
                $response['code'] = '404';
                $response['status'] = 'Failed';
                $response['message'] = 'Not found';
            } else {


                $presensi = Presensi::findOne($id_presensi);
                $presensi->status = "close";
                $presensi->update(false);


                $response['code'] = '200';
                $response['status'] = 'OK';
                $response['message'] = 'Konfirmasi success, presensi closed';

            }

        }


        return $response;
    }

    /*
     * fungsi yang digunakan mahasiswa untuk melihat histori presensi berdasarkan inputan Nim dan Tanggal
     */
    public function actionHistoriPresensiByNimAndDate($nim, $date){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isGet){
            $sql = "SELECT tb_presensi_detail.id_presensi, tb_presensi_detail.nim, tb_presensi_detail.waktu, tb_presensi_detail.status, 
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
            $response = Mahasiswa::findAllHabisJatahByIdPresensi($id_presensi);
        }

        return $response;
    }
}