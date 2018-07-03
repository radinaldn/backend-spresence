<?php
/**
 * Created by PhpStorm.
 * User: radinaldn
 * Date: 16/06/18
 * Time: 8:02
 */

namespace app\api\modules\v1\controllers;


use yii\web\Controller;
use yii\web\Response;
use Yii;
use app\models\Presensi;
use app\models\BarcodeQR;

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
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isPost){

            $data = Yii::$app->request->post();

            $model = new Presensi();
            $model->id_mengajar = $data['id_mengajar'];


            // get presensi sebelumnya
//            $last_presensi = Presensi::find()
//                            ->where(['id_mengajar' => $model->id_mengajar])
//                            ->orderBy(['id_presensi' => SORT_DESC])
//                            ->one();


            // pertemuan saat ini = pertemuan sebelumnya + 1 (dilakukan konversi ke string karna data tipe int tidak diperbolehkan)

            // jika presensi days1
//            if ($last_presensi == null){
//                $model->pertemuan = "1";
//            } else {
//                $model->pertemuan = strval($last_presensi->pertemuan+1);
//            }

            if ($model->pertemuan == null){
                $model->pertemuan = "1";
            } else {
                $model->pertemuan = strval($model->pertemuan+1);
            }

            $model->id_ruangan= $data['id_ruangan'];

            // get curdatetime
            $model->waktu = date('Y-m-d H:i:s');
            $model->status = "open";


            if($model->save()){
                $current_presensi = Presensi::findOne($model->id_presensi);

                $current_presensi->qr_code = $model->id_presensi.".png";
                // generate qr-code here
                $qr = new BarcodeQR();

                $qr_content = $model->id_presensi."-".$data['lat']."-".$data['lng'];

                // create URL QR Code
                $qr->text($qr_content);
                $qr->draw(200, Yii::$app->getBasePath()."/web/files/qrcode/".$current_presensi->qr_code);


                $current_presensi->save();
                $response['status'] = 'OK';
                $response['id_presensi'] =$model->id_presensi;
            } else {
                $response['status'] = 'FAILED';
            }
        }

        return $response;
    }

    public function actionHistoriMengajarByNipAndDate($nip, $date){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isGet){
            $sql = "SELECT tb_presensi.id_presensi, tb_dosen.nama as nama_dosen, tb_matakuliah.nama as nama_matakuliah,
                    tb_presensi.pertemuan, tb_kelas.nama as nama_kelas, tb_presensi.waktu 
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
}