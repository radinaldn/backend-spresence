<?php
/**
 * Created by PhpStorm.
 * User: radinaldn
 * Date: 09/06/18
 * Time: 7:07
 */

namespace app\api\modules\v1\controllers;

use app\models\Dosen;
use app\models\KehadiranDosen;
use yii\rest\Controller;
use yii\web\Response;
use Yii;

class DosenController extends Controller
{
    /*
    get all dosen
    */

    public function actionFindAllByStatusKehadiran($status_kehadiran){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isGet){
            $sql = "SELECT tb_kehadiran_dosen.nip, tb_dosen.nama as nama_dosen, tb_dosen.foto, 
                    tb_kehadiran_dosen.status_kehadiran, tb_kehadiran_dosen.nama_kota, DATE_FORMAT(tb_kehadiran_dosen.last_update, \"%d/%m/%Y %H:%i:%s\") as last_update
                    FROM tb_kehadiran_dosen INNER JOIN tb_dosen 
                    WHERE tb_kehadiran_dosen.nip = tb_dosen.nip
                    AND tb_kehadiran_dosen.status_kehadiran='$status_kehadiran'";

            $response['master'] = Yii::$app->db->createCommand($sql)->queryAll();
        }
        return $response;
    }


    /*
     * login dosen
     */
    public function actionLogin(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isPost){
            $data = Yii::$app->request->post();
            $password = sha1($data['password']);

            $user = Dosen::find()
                    ->where(['nip' => $data['username']])
                    ->andWhere(['password' => $password])
                    ->andWhere(['imei' => $data['imei']])
                    ->all();


            if(isset($user)){
                if($user==null){
                    $response['status'] = 'invalid username, password or imei';
                    $response['data'] = $user;
                } else {
                    $response['status'] = 'success';
                    $response['data'] = $user;
                }

            } else {
                $response['status'] = 'failed';
            }
        }

        return $response;
    }

    /*
    update status kehadiran dosen
    */
    public function actionUpdateLocation(){
        Yii::$app->timeZone = 'Asia/Jakarta';
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isPost){
            $data = Yii::$app->request->post();
            $nip = $data['nip'];
            $nama_kota = $data['nama_kota'];
            $status_kehadiran = $data['status_kehadiran'];

            $dosen = KehadiranDosen::find()
                    ->where(['nip' => $nip])
                    ->one();

            $dosen->status_kehadiran = $status_kehadiran;
            $dosen->last_update = date('Y-m-d H:i:s');
            $dosen->nama_kota = $nama_kota;

            $dosen->update(false);

            $response['code'] = '200';
            $response['status'] = 'success';
            $response['message'] = 'Kehadiran berhasil diperbarui';
        }

        return $response;
    }

}