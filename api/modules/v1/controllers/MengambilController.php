<?php
/**
 * Created by PhpStorm.
 * User: radinaldn
 * Date: 25/06/18
 * Time: 14:37
 */

namespace app\api\modules\v1\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class MengambilController extends Controller
{
    /*
     * fungsi mendapatkan semua data matakuliah hari ini yang diambil berdasarkan inputan NIM
     */
    public function actionFindAllTodayByNim($nim){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if (Yii::$app->request->isGet){
            $sql = "SELECT tb_mengambil.id_mengambil, tb_mengambil.id_mengajar, (4 - tb_mengambil.jumlah_ketidakhadiran) as sisa_jatah, tb_matakuliah.nama as nama_matakuliah, tb_matakuliah.nama as nama_matakuliah, 
                    tb_dosen.nama as nama_dosen, DATE_FORMAT(tb_mengajar.waktu_mulai, '%H:%i:%s') as waktu_mulai, DAYNAME(tb_mengajar.waktu_mulai) as hari, 
                    tb_kelas.nama as nama_kelas,
                    tb_matakuliah.sks FROM tb_mengambil 
                    INNER JOIN tb_mengajar, tb_matakuliah, tb_semester_aktif, tb_dosen, tb_kelas 
                    WHERE tb_mengambil.id_mengajar = tb_mengajar.id_mengajar 
                    AND tb_mengajar.id_matakuliah = tb_matakuliah.id_matakuliah 
                    AND tb_mengajar.id_semester_aktif = tb_semester_aktif.id_semester_aktif 
                    AND tb_mengajar.nip = tb_dosen.nip AND tb_mengambil.nim = '$nim'
                    AND tb_mengajar.id_kelas = tb_kelas.id_kelas
                    AND DAYNAME(tb_mengajar.waktu_mulai) = DAYNAME(CURDATE())
                    AND tb_semester_aktif.status = 'Aktif'
                    ORDER BY tb_mengajar.waktu_mulai ASC";

            $response['master'] = Yii::$app->db->createCommand($sql)->queryAll();
        }

        return $response;
    }

    /*
     * fungsi mendapatkan semua data matakuliah yang diambil berdasarkan inputan NIM dan Nama Hari
     */
    public function actionFindAllByNimAndDayname($nim, $dayname){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isGet){
            $sql = "SELECT tb_mengambil.id_mengambil, tb_mengambil.id_mengajar, (4 - tb_mengambil.jumlah_ketidakhadiran) as sisa_jatah, tb_matakuliah.nama as nama_matakuliah, tb_dosen.nama 
                    as nama_dosen, DATE_FORMAT(tb_mengajar.waktu_mulai, '%H:%i:%s') as waktu_mulai, DAYNAME(tb_mengajar.waktu_mulai) as hari, tb_matakuliah.sks,
                    tb_kelas.nama as nama_kelas
                    FROM tb_mengambil INNER JOIN tb_mengajar, tb_matakuliah, tb_semester_aktif, tb_dosen, tb_kelas 
                    WHERE tb_mengambil.id_mengajar = tb_mengajar.id_mengajar 
                    AND tb_mengajar.id_matakuliah = tb_matakuliah.id_matakuliah 
                    AND tb_mengajar.id_semester_aktif = tb_semester_aktif.id_semester_aktif 
                    AND tb_mengajar.nip = tb_dosen.nip
                    AND tb_mengajar.id_kelas = tb_kelas.id_kelas 
                    AND tb_mengambil.nim = '$nim' 
                    AND DAYNAME(tb_mengajar.waktu_mulai) = '$dayname' 
                    AND tb_semester_aktif.status = 'Aktif' 
                    ORDER BY tb_mengajar.waktu_mulai ASC";

            $response['master'] = Yii::$app->db->createCommand($sql)->queryAll();
        }

        return $response;
    }
}