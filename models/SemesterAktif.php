<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_semester_aktif".
 *
 * @property int $id_semester_aktif
 * @property string $semester
 * @property int $tahun
 * @property string $status
 *
 * @property TbMengajar[] $tbMengajars
 */
class SemesterAktif extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_semester_aktif';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['semester', 'tahun', 'status'], 'required'],
            [['semester', 'status'], 'string'],
            [['tahun'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_semester_aktif' => 'Id Semester Aktif',
            'semester' => 'Semester',
            'tahun' => 'Tahun',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbMengajars()
    {
        return $this->hasMany(Mengajar::className(), ['id_semester_aktif' => 'id_semester_aktif']);
    }
}
