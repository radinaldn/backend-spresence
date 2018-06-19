<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_matakuliah".
 *
 * @property int $id_matakuliah
 * @property string $nama
 * @property int $sks
 * @property int $id_semester_aktif
 *
 * @property TbSemesterAktif $semesterAktif
 * @property TbMengajar[] $tbMengajars
 */
class Matakuliah extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_matakuliah';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'sks', 'id_semester_aktif'], 'required'],
            [['sks', 'id_semester_aktif'], 'integer'],
            [['nama'], 'string', 'max' => 255],
            [['id_semester_aktif'], 'exist', 'skipOnError' => true, 'targetClass' => SemesterAktif::className(), 'targetAttribute' => ['id_semester_aktif' => 'id_semester_aktif']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_matakuliah' => 'Id Matakuliah',
            'nama' => 'Nama',
            'sks' => 'Sks',
            'id_semester_aktif' => 'Id Semester Aktif',
        ];
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
    public function getTbMengajars()
    {
        return $this->hasMany(Mengajar::className(), ['id_matakuliah' => 'id_matakuliah']);
    }
}
