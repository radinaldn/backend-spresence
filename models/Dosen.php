<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_dosen".
 *
 * @property int $nip
 * @property string $password
 * @property int $imei
 * @property string $nama
 * @property string $jk
 * @property string $foto
 *
 * @property TbMengajar[] $tbMengajars
 */
class Dosen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_dosen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nip', 'password', 'imei', 'nama', 'jk', 'foto'], 'required'],
            [['nip', 'imei'], 'integer'],
            [['jk'], 'string'],
            [['password', 'nama', 'foto'], 'string', 'max' => 255],
            [['nip', 'imei'], 'unique', 'targetAttribute' => ['nip', 'imei']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nip' => 'Nip',
            'password' => 'Password',
            'imei' => 'IMEI',
            'nama' => 'Nama Dosen',
            'jk' => 'Jenis Kelamin',
            'foto' => 'Foto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbMengajars()
    {
        return $this->hasMany(Mengajar::className(), ['nip' => 'nip']);
    }
}
