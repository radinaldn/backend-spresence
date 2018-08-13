<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_jurusan".
 *
 * @property int $id_jurusan
 * @property int $id_fakultas
 * @property string $nama
 *
 * @property TbFakultas $fakultas
 * @property TbMahasiswa[] $tbMahasiswas
 */
class Jurusan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_jurusan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_fakultas', 'nama'], 'required'],
            [['id_fakultas'], 'integer'],
            [['nama'], 'string', 'max' => 100],
            [['id_fakultas'], 'exist', 'skipOnError' => true, 'targetClass' => Fakultas::className(), 'targetAttribute' => ['id_fakultas' => 'id_fakultas']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_jurusan' => 'Id Jurusan',
            'id_fakultas' => 'Id Fakultas',
            'nama' => 'Jurusan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFakultas()
    {
        return $this->hasOne(Fakultas::className(), ['id_fakultas' => 'id_fakultas']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbMahasiswas()
    {
        return $this->hasMany(Mahasiswa::className(), ['id_jurusan' => 'id_jurusan']);
    }
}
