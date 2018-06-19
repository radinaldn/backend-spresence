<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_presensi_detail".
 *
 * @property int $id_presensi
 * @property int $nim
 * @property string $status
 * @property double $lat
 * @property double $lng
 * @property string $waktu
 * @property int $jarak
 *
 * @property TbMahasiswa $nim0
 * @property TbPresensi $presensi
 */
class PresensiDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_presensi_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_presensi', 'nim', 'status', 'lat', 'lng', 'waktu', 'jarak'], 'required'],
            [['id_presensi', 'nim', 'jarak'], 'integer'],
            [['status'], 'string'],
            [['lat', 'lng'], 'number'],
            [['waktu'], 'safe'],
            [['nim'], 'exist', 'skipOnError' => true, 'targetClass' => Mahasiswa::className(), 'targetAttribute' => ['nim' => 'nim']],
            [['id_presensi'], 'exist', 'skipOnError' => true, 'targetClass' => Presensi::className(), 'targetAttribute' => ['id_presensi' => 'id_presensi']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_presensi' => 'Id Presensi',
            'nim' => 'Nim',
            'status' => 'Status',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'waktu' => 'Waktu',
            'jarak' => 'Jarak',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNim0()
    {
        return $this->hasOne(Mahasiswa::className(), ['nim' => 'nim']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresensi()
    {
        return $this->hasOne(Presensi::className(), ['id_presensi' => 'id_presensi']);
    }
}