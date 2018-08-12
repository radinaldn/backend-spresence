<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_kelas".
 *
 * @property int $id_kelas
 * @property string $nama
 *
 * @property TbMengajar[] $tbMengajars
 */
class Kelas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_kelas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['nama'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_kelas' => 'Id Kelas',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMengajars()
    {
        return $this->hasMany(Mengajar::className(), ['id_kelas' => 'id_kelas']);
    }
}
