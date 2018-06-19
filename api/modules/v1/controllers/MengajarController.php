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
    // get all dosen
    public function actionFindAllBy($nip){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isGet){
            $sql = "SELECT tb_mengajar.id_mengajar, tb_mengajar.id_matakuliah, 
                    tb_mengajar.nip, tb_mengajar.waktu_mulai, tb_mengajar.kelas, tb_matakuliah.id_semester_aktif, 
                    tb_semester_aktif.semester, tb_semester_aktif.status 
                    FROM tb_mengajar INNER JOIN tb_matakuliah, tb_semester_aktif 
                    WHERE tb_mengajar.id_matakuliah = tb_matakuliah.id_matakuliah 
                    AND tb_matakuliah.id_semester_aktif = tb_semester_aktif.id_semester_aktif 
                    AND tb_mengajar.nip = '$nip'
                    ORDER BY tb_mengajar.waktu_mulai ASC";

            $response['master'] = Yii::$app->db->createCommand($sql)->queryAll();
        }
        return $response;
    }

    public function actionFindAllTodayBy($nip){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isGet){
            $sql = "SELECT tb_mengajar.id_mengajar, tb_mengajar.id_matakuliah, 
                    tb_mengajar.nip, tb_mengajar.id_kelas, tb_mengajar.waktu_mulai, DAYNAME(tb_mengajar.waktu_mulai) as hari, tb_matakuliah.id_semester_aktif, tb_semester_aktif.semester, tb_semester_aktif.status 
                    FROM tb_mengajar INNER JOIN tb_matakuliah, tb_semester_aktif 
                    WHERE tb_mengajar.id_matakuliah = tb_matakuliah.id_matakuliah 
                    AND tb_matakuliah.id_semester_aktif = tb_semester_aktif.id_semester_aktif
                    AND DAYNAME(tb_mengajar.waktu_mulai) = DAYNAME(CURDATE()) 
                    AND tb_mengajar.nip = '$nip'
                    ORDER BY tb_mengajar.waktu_mulai ASC";

            $response['master'] = Yii::$app->db->createCommand($sql)->queryAll();
        }
        return $response;
    }
}