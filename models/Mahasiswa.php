<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_mahasiswa".
 *
 * @property int $nim
 * @property string $password
 * @property int $imei
 * @property string $nama
 * @property string $jk
 * @property string $foto
 * @property int $id_jurusan
 *
 * @property TbJurusan $jurusan
 * @property TbMengambil[] $tbMengambils
 * @property TbPresensiDetail[] $tbPresensiDetails
 */
class Mahasiswa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_mahasiswa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nim', 'password', 'imei', 'nama', 'jk', 'foto', 'id_jurusan'], 'required'],
            [['nim', 'imei', 'id_jurusan'], 'integer'],
            [['jk'], 'string'],
            [['password', 'nama', 'foto'], 'string', 'max' => 255],
            [['nim', 'imei'], 'unique', 'targetAttribute' => ['nim', 'imei']],
            [['id_jurusan'], 'exist', 'skipOnError' => true, 'targetClass' => Jurusan::className(), 'targetAttribute' => ['id_jurusan' => 'id_jurusan']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nim' => 'Nim',
            'password' => 'Password',
            'imei' => 'IMEI',
            'nama' => 'Nama Mahasiswa',
            'jk' => 'Jenis Kelamin',
            'foto' => 'Foto',
            'id_jurusan' => 'Id Jurusan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJurusan()
    {
        return $this->hasOne(Jurusan::className(), ['id_jurusan' => 'id_jurusan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbMengambils()
    {
        return $this->hasMany(Mengambil::className(), ['nim' => 'nim']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbPresensiDetails()
    {
        return $this->hasMany(PresensiDetail::className(), ['nim' => 'nim']);
    }


    public static function sendAlertKetidakhadiran($telegram_id, $message_text, $secret_token) {
        $url = "https://api.telegram.org/" . $secret_token . "/sendMessage?parse_mode=markdown&chat_id=" . $telegram_id;
        $url = $url . "&text=" . urlencode($message_text);
        $ch = curl_init();
        $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        curl_close($ch);

    }

    /*----------------------
    only basic POST method :
    -----------------------*/
    // $telegram_id = $_POST ['telegram_id'];
    // $message_text = $_POST ['message_text'];
    /*--------------------------------
    Isi TOKEN dibawah ini:
    --------------------------------*/
    //$secret_token = "bot579741209:AAHELNwUG-8hwTBnszEO4m5eMA_4AnJnnD8";
    //sendMessage($telegram_id, $message_text, $secret_token);

    public static function findAllHabisJatahByIdPresensi($id_presensi){
        $sql = "SELECT tb_mengambil.id_mengambil, tb_mengambil.nim, tb_mengambil.jumlah_ketidakhadiran, 
                tb_mahasiswa.id_telegram, tb_mahasiswa.nama, 
                tb_matakuliah.nama as nama_matakuliah, tb_presensi.id_presensi 
                FROM tb_mengambil INNER JOIN tb_mahasiswa, tb_mengajar, tb_matakuliah, tb_presensi 
                WHERE tb_mengambil.nim = tb_mahasiswa.nim 
                AND tb_mengambil.id_mengajar = tb_mengajar.id_mengajar 
                AND tb_mengajar.id_matakuliah = tb_matakuliah.id_matakuliah 
                AND tb_presensi.id_mengajar = tb_mengajar.id_mengajar 
                AND tb_mengambil.jumlah_ketidakhadiran > 2 
                AND tb_presensi.id_presensi = '$id_presensi'";

        return Yii::$app->db->createCommand($sql)->queryAll();
    }
}
