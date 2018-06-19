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

class PresensiController extends Controller
{
    // mengecek apakah masih boeh absen atau tidak?
    public function actionIsClose(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
        }
    }

    // memulai presensi kelas (MASIH BUG)
    public function actionAdd(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isPost){

            $data = Yii::$app->request->post();

            $model = new Presensi();
            $model->id_mengajar = $data['id_mengajar'];

            // pertemuan = lastPertemuan + 1;

            // get presensi sebelumnya
            $last_presensi = Presensi::find()
                            ->where(['id_mengajar' => $model->id_mengajar])
                            ->orderBy(['id_presensi' => SORT_DESC])
                            ->one();

            // pertemuan saat ini = pertemuan sebelumnya + 1 (dilakukan konversi ke string karna data tipe int tidak diperbolehkan)
            $model->pertemuan = strval($last_presensi->pertemuan+1);

            $model->id_ruangan= $data['id_ruangan'];

            // get curdatetime
            $model->waktu = date('Y-m-d H:i:s');


            if($model->save()){
                $current_presensi = Presensi::findOne($model->id_presensi);

                // generate qr-code here

                $current_presensi->qr_code = $model->id_presensi.".png";
                $current_presensi->save();
                $response = 'OK';
            } else {
                $response = 'FAILED';
            }
        }

        return $response;
    }
}