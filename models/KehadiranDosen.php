<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_kehadiran_dosen".
 *
 * @property int $nip
 * @property string $status_kehadiran
 * @property string $nama_kota
 * @property string $last_update
 *
 * @property TbDosen $nip0
 */
class KehadiranDosen extends \yii\db\ActiveRecord
{
    const HADIR = "Hadir";
    const TIDAK_HADIR = "Tidak Hadir";

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_kehadiran_dosen';
    }

    public static function primaryKey()
    {
        return ['nip'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nip', 'status_kehadiran'], 'required'],
            [['nip'], 'integer'],
            [['status_kehadiran'], 'string'],
            [['last_update'], 'safe'],
            [['nama_kota'], 'string', 'max' => 100],
            [['nip'], 'exist', 'skipOnError' => true, 'targetClass' => Dosen::className(), 'targetAttribute' => ['nip' => 'nip']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nip' => 'Nip',
            'status_kehadiran' => 'Status Kehadiran',
            'nama_kota' => 'Nama Kota',
            'last_update' => 'Last Update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNip0()
    {
        return $this->hasOne(Dosen::className(), ['nip' => 'nip']);
    }

    /**
     * Mendapatkan semua data kehadiran dosen
     */

    public static function findAllDetail(){
        $sql = "SELECT tb_kehadiran_dosen.nip, tb_dosen.nama as nama_dosen, tb_dosen.foto, 
                    tb_kehadiran_dosen.status_kehadiran, tb_kehadiran_dosen.nama_kota, DATE_FORMAT(tb_kehadiran_dosen.last_update, \"%d/%m/%Y %H:%i:%s\") as last_update
                    FROM tb_kehadiran_dosen INNER JOIN tb_dosen 
                    WHERE tb_kehadiran_dosen.nip = tb_dosen.nip
                    ORDER BY tb_kehadiran_dosen.last_update DESC";

        return Yii::$app->db->createCommand($sql)->queryAll();;
    }
}
