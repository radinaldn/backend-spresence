<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_presensi".
 *
 * @property int $id_presensi
 * @property int $id_mengajar
 * @property string $pertemuan
 * @property int $id_ruangan
 * @property string $waktu
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
            [['pertemuan'], 'string'],
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
}
