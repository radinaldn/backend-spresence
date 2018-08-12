<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_fakultas".
 *
 * @property int $id_fakultas
 * @property string $nama
 * @property double $titik_a_lat
 * @property double $titik_a_lng
 * @property double $titik_b_lat
 * @property double $titik_b_lng
 * @property double $titik_c_lat
 * @property double $titik_c_lng
 * @property double $titik_d_lat
 * @property double $titik_d_lng
 *
 * @property TbJurusan[] $tbJurusans
 */
class Fakultas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_fakultas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'titik_a_lat', 'titik_a_lng', 'titik_b_lat', 'titik_b_lng', 'titik_c_lat', 'titik_c_lng', 'titik_d_lat', 'titik_d_lng'], 'required'],
            [['titik_a_lat', 'titik_a_lng', 'titik_b_lat', 'titik_b_lng', 'titik_c_lat', 'titik_c_lng', 'titik_d_lat', 'titik_d_lng'], 'number'],
            [['nama'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_fakultas' => 'Id Fakultas',
            'nama' => 'Nama',
            'titik_a_lat' => 'Titik A Lat',
            'titik_a_lng' => 'Titik A Lng',
            'titik_b_lat' => 'Titik B Lat',
            'titik_b_lng' => 'Titik B Lng',
            'titik_c_lat' => 'Titik C Lat',
            'titik_c_lng' => 'Titik C Lng',
            'titik_d_lat' => 'Titik D Lat',
            'titik_d_lng' => 'Titik D Lng',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbJurusans()
    {
        return $this->hasMany(Jurusan::className(), ['id_fakultas' => 'id_fakultas']);
    }
}
