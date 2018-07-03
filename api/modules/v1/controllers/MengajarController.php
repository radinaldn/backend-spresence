<?php
/**
 * Created by PhpStorm.
 * User: radinaldn
 * Date: 16/06/18
 * Time: 7:08
 */

namespace app\api\modules\v1\controllers;


use yii\web\Controller;
use app\models\Mengajar;
use app\models\Dosen;
use yii\web\Response;
use Yii;

class MengajarController extends Controller
{

    /*
     * fungsi mendapatkan semua data mengajar yg aktif berdasarkan inputan NIP
     */
    public function actionFindAllByNip($nip){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isGet){
            $model = Mengajar::find()
                    ->joinWith('matakuliah')
                    ->joinWith('matakuliah.semesterAktif')
                    ->where(['tb_semester_aktif.status' => 'Aktif'])
                    ->andWhere(['nip' => $nip])
                    ->orderBy(['waktu_mulai' => SORT_ASC])
                    ->all();



            $response['master'] = $model;
        }
        return $response;
    }

    /*
     * fungsi mendapatkan data mengajar hari ini berdasarkan inputan NIP
     */
    public function actionFindAllTodayByNip($nip){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isGet){
            $sql = "SELECT tb_mengajar.id_mengajar, tb_mengajar.nip, tb_dosen.nama as nama_dosen,
                    tb_kelas.nama as nama_kelas, tb_mengajar.waktu_mulai, DAYNAME(tb_mengajar.waktu_mulai) 
                    as hari, tb_matakuliah.nama as nama_matakuliah, tb_matakuliah.sks, tb_semester_aktif.status 
                    FROM tb_mengajar INNER JOIN tb_matakuliah, tb_semester_aktif, tb_dosen, tb_kelas 
                    WHERE tb_mengajar.id_matakuliah = tb_matakuliah.id_matakuliah 
                    AND tb_matakuliah.id_semester_aktif = tb_semester_aktif.id_semester_aktif 
                    AND tb_mengajar.nip = tb_dosen.nip 
                    AND tb_mengajar.id_kelas = tb_kelas.id_kelas 
                    AND tb_mengajar.nip = '$nip' 
                    AND tb_semester_aktif.status = 'Aktif' 
                    AND DAYNAME(tb_mengajar.waktu_mulai) = DAYNAME(CURDATE()) 
                    ORDER BY tb_mengajar.waktu_mulai ASC";

            $response['master'] = Yii::$app->db->createCommand($sql)->queryAll();
        }
        return $response;
    }

    /*
     * fungsi mendapatkan data mengajar berdasarkan inputan NIP dan Nama Hari
     */
    public function actionFindAllByNipAndDayname($nip, $dayname){

        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if (Yii::$app->request->isGet){
            $sql = "SELECT tb_mengajar.id_mengajar, tb_mengajar.nip, tb_dosen.nama as nama_dosen,
                    tb_kelas.nama as nama_kelas, tb_mengajar.waktu_mulai, DAYNAME(tb_mengajar.waktu_mulai) 
                    as hari, tb_matakuliah.nama as nama_matakuliah, tb_matakuliah.sks, tb_semester_aktif.status 
                    FROM tb_mengajar INNER JOIN tb_matakuliah, tb_semester_aktif, tb_dosen, tb_kelas 
                    WHERE tb_mengajar.id_matakuliah = tb_matakuliah.id_matakuliah 
                    AND tb_matakuliah.id_semester_aktif = tb_semester_aktif.id_semester_aktif 
                    AND tb_mengajar.nip = tb_dosen.nip 
                    AND tb_mengajar.id_kelas = tb_kelas.id_kelas 
                    AND tb_mengajar.nip = '$nip' 
                    AND tb_semester_aktif.status = 'Aktif' 
                    AND DAYNAME(tb_mengajar.waktu_mulai) = '$dayname' 
                    ORDER BY tb_mengajar.waktu_mulai ASC";

            $response['master'] = Yii::$app->db->createCommand($sql)->queryAll();

        }

        return $response;
    }
}