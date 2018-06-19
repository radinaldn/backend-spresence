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
}
