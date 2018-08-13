<?php

namespace app\models;

use Yii;
use yii\data\SqlDataProvider;

/**
 * This is the model class for table "tb_presensi".
 *
 * @property int $id_presensi
 * @property int $id_mengajar
 * @property string $pertemuan
 * @property int $id_ruangan
 * @property string $waktu
 * @property string $status
 * @property string $qr_code
 *
 * @property TbMengajar $mengajar
 * @property TbRuangan $ruangan
 * @property TbPresensiDetail[] $tbPresensiDetails
 */
class Presensi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_presensi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_mengajar', 'pertemuan', 'id_ruangan'], 'required'],
            [['id_mengajar', 'id_ruangan'], 'integer'],
            [['pertemuan', 'status'], 'string'],
            [['waktu'], 'safe'],
            [['qr_code'], 'string', 'max' => 255],
            [['id_mengajar'], 'exist', 'skipOnError' => true, 'targetClass' => Mengajar::className(), 'targetAttribute' => ['id_mengajar' => 'id_mengajar']],
            [['id_ruangan'], 'exist', 'skipOnError' => true, 'targetClass' => Ruangan::className(), 'targetAttribute' => ['id_ruangan' => 'id_ruangan']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_presensi' => 'Id Presensi',
            'id_mengajar' => 'Id Mengajar',
            'pertemuan' => 'Pertemuan',
            'id_ruangan' => 'Id Ruangan',
            'waktu' => 'Waktu',
            'status' => 'Status',
            'qr_code' => 'Qr Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMengajar()
    {
        return $this->hasOne(Mengajar::className(), ['id_mengajar' => 'id_mengajar']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuangan()
    {
        return $this->hasOne(Ruangan::className(), ['id_ruangan' => 'id_ruangan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbPresensiDetails()
    {
        return $this->hasMany(PresensiDetail::className(), ['id_presensi' => 'id_presensi']);
    }

    public static function findAllByDate($date){
        $sql = "SELECT tb_presensi.id_presensi,
                    (SELECT COUNT(nim) FROM tb_presensi_detail WHERE tb_presensi_detail.status = \"Hadir\" AND tb_presensi_detail.id_presensi = tb_presensi.id_presensi) as total_hadir, 
                    (SELECT COUNT(nim) FROM tb_presensi_detail WHERE tb_presensi_detail.status = \"Tidak Hadir\" AND tb_presensi_detail.id_presensi = tb_presensi.id_presensi) as total_tidak_hadir, 
                    tb_dosen.nama as nama_dosen, tb_dosen.foto,tb_matakuliah.nama as nama_matakuliah,
                    tb_presensi.pertemuan, tb_kelas.nama as kelas, tb_ruangan.nama as nama_ruangan, DATE_FORMAT(tb_presensi.waktu, '%r') as waktu 
                    FROM tb_presensi INNER JOIN tb_mengajar, tb_dosen, tb_matakuliah, tb_kelas, tb_ruangan 
                    WHERE tb_presensi.id_mengajar = tb_mengajar.id_mengajar 
                    AND tb_mengajar.nip = tb_dosen.nip 
                    AND tb_mengajar.id_matakuliah = tb_matakuliah.id_matakuliah 
                    AND tb_mengajar.id_kelas = tb_kelas.id_kelas 
                    AND tb_presensi.id_ruangan = tb_ruangan.id_ruangan
                    AND DATE_FORMAT(waktu,'%Y-%m-%d') = '$date'
                    ORDER BY tb_presensi.waktu DESC";


        return Yii::$app->db->createCommand($sql)->queryAll();;
    }
}
