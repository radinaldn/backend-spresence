<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_ruangan".
 *
 * @property int $id_ruangan
 * @property string $nama
 *
 * @property TbPresensi[] $tbPresensis
 */
class Ruangan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_ruangan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['nama'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ruangan' => 'Id Ruangan',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbPresensis()
    {
        return $this->hasMany(Presensi::className(), ['id_ruangan' => 'id_ruangan']);
    }
}
