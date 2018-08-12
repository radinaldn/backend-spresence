<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_mengajar".
 *
 * @property int $id_mengajar
 * @property int $id_matakuliah
 * @property int $nip
 * @property string $waktu_mulai
 * @property int $id_kelas
 * @property int $id_semester_aktif
 *
 * @property TbDosen $nip0
 * @property TbKelas $kelas
 * @property TbMatakuliah $matakuliah
 * @property TbSemesterAktif $semesterAktif
 * @property TbMengambil[] $tbMengambils
 * @property TbPresensi[] $tbPresensis
 */
class Mengajar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_mengajar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_matakuliah', 'nip', 'id_kelas', 'id_semester_aktif'], 'required'],
            [['id_matakuliah', 'nip', 'id_kelas', 'id_semester_aktif'], 'integer'],
            [['waktu_mulai'], 'safe'],
            [['nip'], 'exist', 'skipOnError' => true, 'targetClass' => Dosen::className(), 'targetAttribute' => ['nip' => 'nip']],
            [['id_kelas'], 'exist', 'skipOnError' => true, 'targetClass' => Kelas::className(), 'targetAttribute' => ['id_kelas' => 'id_kelas']],
            [['id_matakuliah'], 'exist', 'skipOnError' => true, 'targetClass' => Matakuliah::className(), 'targetAttribute' => ['id_matakuliah' => 'id_matakuliah']],
            [['id_semester_aktif'], 'exist', 'skipOnError' => true, 'targetClass' => SemesterAktif::className(), 'targetAttribute' => ['id_semester_aktif' => 'id_semester_aktif']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_mengajar' => 'Id Mengajar',
            'id_matakuliah' => 'Id Matakuliah',
            'nip' => 'Nip',
            'waktu_mulai' => 'Waktu Mulai',
            'id_kelas' => 'Id Kelas',
            'id_semester_aktif' => 'Id Semester Aktif',
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
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasOne(Kelas::className(), ['id_kelas' => 'id_kelas']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatakuliah()
    {
        return $this->hasOne(Matakuliah::className(), ['id_matakuliah' => 'id_matakuliah']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSemesterAktif()
    {
        return $this->hasOne(SemesterAktif::className(), ['id_semester_aktif' => 'id_semester_aktif']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbMengambils()
    {
        return $this->hasMany(Mengambil::className(), ['id_mengajar' => 'id_mengajar']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbPresensis()
    {
        return $this->hasMany(Presensi::className(), ['id_mengajar' => 'id_mengajar']);
    }
}
