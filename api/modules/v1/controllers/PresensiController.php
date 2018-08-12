<?php
/**
 * Created by PhpStorm.
 * User: radinaldn
 * Date: 16/06/18
 * Time: 8:02
 */

namespace app\api\modules\v1\controllers;


use app\models\KehadiranDosen;
use app\models\Mengajar;
use app\models\PresensiDetail;
use app\models\Ruangan;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;
use Yii;
use app\models\Presensi;


class PresensiController extends Controller
{
    /*
    mengecek apakah masih boleh absen atau tidak?
    */
    public function actionIsClose($id_presensi){

        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;



        if(Yii::$app->request->isGet) {

            $model = Presensi::findOne($id_presensi);

            if(isset($model)){
                if($model==null){
                    $response['status'] = 'failed';
                    $response['data'] = 'null';
                } else {
                    $response['status'] = '200';
                    $response['data'] = $model->status;
                }

            } else {
                $response['status'] = '404';
                $response['data'] = 'invalid id_presensi';
            }
        }

        return $response;
    }

    /*
     * memulai presensi kelas (ALMOST FIX)
     */
    public function actionAdd(){
        Yii::$app->timeZone = 'Asia/Jakarta';
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isPost) {

            $data = Yii::$app->request->post();

            $model = new Presensi();
            $model->id_mengajar = $data['id_mengajar'];


            // get presensi sebelumnya
            $last_presensi = Presensi::find()
                ->where(['id_mengajar' => $model->id_mengajar])
                ->orderBy(['id_presensi' => SORT_DESC])
                ->one();



//             pertemuan saat ini = pertemuan sebelumnya + 1 (dilakukan konversi ke string karna data tipe int tidak diperbolehkan)
            if ($last_presensi != null && $last_presensi->pertemuan == "16") {
                $response['status'] = 'FAILED';
                $response['message'] = 'Sudah mencapai batas maksimal pertemuan';
            } else if ($last_presensi != null && $last_presensi->status == "open"){
                $response['status'] = 'FAILED';
                $response['message'] = 'Status presensi sebelumnya open, id_presensi : '.$last_presensi->id_presensi;
            } else {

                // jika presensi days1
                if ($last_presensi == null) {
                    $model->pertemuan = "1";
                // jika tidak, increement nilai pertemuan
                } else{
                    $model->pertemuan = strval($last_presensi->pertemuan+=1);
                }

                $model->id_ruangan= $data['id_ruangan'];

                // get curdatetime
                $model->waktu = date('Y-m-d H:i:s');
                $model->status = "open";


                if($model->save()){

                    // get data presensi saat ini
                    $current_presensi = Presensi::findOne($model->id_presensi);
                    $current_presensi->qr_code = $model->id_presensi.".png";

                    // variable isian qr-code
                    $qr_content = $model->id_presensi."#".$data['lat']."#".$data['lng'];

                    // generate QR Code
                    $qrCode = new QrCode($qr_content);
                    // create URL QR Code
                    $qrCode->setSize(300);

                    $qrCode->setWriterByName('png');
                    $qrCode->setMargin(10);
                    $qrCode->setEncoding('UTF-8');
                    $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH);
                    $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
                    $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
                    $qrCode->setLabel('Scan the code', 10, Yii::$app->getBasePath()."/web/custom/assets/fonts/noto_sans.otf", LabelAlignment::CENTER);
                    $qrCode->setLogoPath(Yii::$app->getBasePath()."/web/files/logo/uin_bnw.jpg");
                    $qrCode->setLogoWidth(100);
                    $qrCode->setRoundBlockSize(true);
                    $qrCode->setValidateResult(false);
                    $qrCode->writeFile(Yii::$app->getBasePath()."/web/files/qrcode/".$current_presensi->qr_code);

                    $response['qr_code'] = "generated";

                    // update field nama qr-code di database
                    $current_presensi->update(false);

                    // set nama all mahasiswa
                    $this->setAllMahasiswaByIdPresensi($model->id_presensi);

                    // update lokasi dosen bahwa sedang mengajar di ruangan ini




                    $kehadiran_dosen = KehadiranDosen::findOne($data['nip']);
                    $kehadiran_dosen->nama_kota = $data['nama_ruangan'];
                    $kehadiran_dosen->status_kehadiran = KehadiranDosen::HADIR;
                    $kehadiran_dosen->last_update = date('Y-m-d H:i:s');
                    $kehadiran_dosen->update(false);


                    $response['status'] = 'OK';
                    $response['id_presensi'] =$model->id_presensi;
                } else {
                    $response['status'] = 'FAILED';
                }
            }

        }

        return $response;
    }

    public function actionHistoriMengajarByNipAndDate($nip, $date){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isGet){
            $sql = "SELECT tb_presensi.id_presensi, tb_dosen.nama as nama_dosen, tb_matakuliah.nama as nama_matakuliah,
                    tb_presensi.pertemuan, tb_kelas.nama as nama_kelas, DATE_FORMAT(tb_presensi.waktu, '%d %b %Y %T') as waktu 
                    FROM tb_presensi INNER JOIN tb_mengajar, tb_dosen, tb_matakuliah, tb_kelas 
                    WHERE tb_presensi.id_mengajar = tb_mengajar.id_mengajar 
                    AND tb_mengajar.nip = tb_dosen.nip 
                    AND tb_mengajar.id_matakuliah = tb_matakuliah.id_matakuliah 
                    AND tb_mengajar.id_kelas = tb_kelas.id_kelas 
                    AND tb_dosen.nip = '$nip' 
                    AND date(tb_presensi.waktu) = '$date'";

            $response['master'] = Yii::$app->db->createCommand($sql)->queryAll();
        }

        return $response;
    }

    // fungsi untuk menset awal nama seluruh mahasiswa yang ikut kuliah di kelas
    public static function setAllMahasiswaByIdPresensi($id_presensi){
        Yii::$app->timeZone = 'Asia/Jakarta';

            $sql_mengambil = "SELECT tb_mengambil.id_mengambil, tb_mengambil.nim, tb_mahasiswa.nama as nama_mahasiswa, tb_mengajar.id_mengajar, tb_presensi.id_presensi 
                              FROM tb_mengambil INNER JOIN tb_mengajar, tb_presensi, tb_mahasiswa
                              WHERE tb_mengambil.id_mengajar = tb_mengajar.id_mengajar 
                              AND tb_mengajar.id_mengajar = tb_presensi.id_mengajar 
                              AND tb_mengambil.nim = tb_mahasiswa.nim
                              AND tb_presensi.id_presensi = '$id_presensi'";

            $model_mengambil = Yii::$app->db->createCommand($sql_mengambil)->queryAll();

            foreach ($model_mengambil as $mahasiswa_mengambil){
                $presensi_detail = new PresensiDetail();
                $presensi_detail->id_presensi = $id_presensi;
                $presensi_detail->nim = $mahasiswa_mengambil['nim'];
                $presensi_detail->status = "Tidak Hadir";
                $presensi_detail->lat = "0";
                $presensi_detail->lng = "0";
                $presensi_detail->waktu = date('Y-m-d H:i:s');
                $presensi_detail->jarak = "0";
                $presensi_detail->proses = "Pending";
                $presensi_detail->save(false);
            }

//            $response['status'] = "OK";
//            $response['message'] = "Set presensi success";


    }

    /*
     * Fungsi mendapatkan data histori mengajar berdasarkan inputan ID Mengajar dan Nama
     */
    public function actionHistoriMengajarByIdMengajar($id_mengajar){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isGet){
            $sql = "SELECT tb_presensi.id_presensi,
                    (SELECT COUNT(nim) FROM tb_presensi_detail WHERE tb_presensi_detail.status = \"Hadir\" AND tb_presensi_detail.id_presensi = tb_presensi.id_presensi) as total_hadir, 
                    (SELECT COUNT(nim) FROM tb_presensi_detail WHERE tb_presensi_detail.status = \"Tidak Hadir\" AND tb_presensi_detail.id_presensi = tb_presensi.id_presensi) as total_tidak_hadir, 
                    tb_dosen.nama as nama_dosen, tb_matakuliah.nama as nama_matakuliah,
                    tb_presensi.pertemuan, tb_kelas.nama as nama_kelas, tb_ruangan.nama as nama_ruangan, DATE_FORMAT(tb_presensi.waktu, '%d %b %Y %T') as waktu 
                    FROM tb_presensi INNER JOIN tb_mengajar, tb_dosen, tb_matakuliah, tb_kelas, tb_ruangan 
                    WHERE tb_presensi.id_mengajar = tb_mengajar.id_mengajar 
                    AND tb_mengajar.nip = tb_dosen.nip 
                    AND tb_mengajar.id_matakuliah = tb_matakuliah.id_matakuliah 
                    AND tb_mengajar.id_kelas = tb_kelas.id_kelas 
                    AND tb_presensi.id_ruangan = tb_ruangan.id_ruangan
                    AND tb_presensi.id_mengajar = '$id_mengajar'
                    ORDER BY tb_presensi.waktu DESC
                    ";

            $response['master'] = Yii::$app->db->createCommand($sql)->queryAll();
        }

        return $response;
    }
}