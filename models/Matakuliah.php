<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_matakuliah".
 *
 * @property int $id_matakuliah
 * @property string $nama
 * @property int $sks
 *
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
            [['nama', 'sks'], 'required'],
            [['sks'], 'integer'],
            [['nama'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_matakuliah' => 'Id Matakuliah',
            'nama' => 'Matakuliah',
            'sks' => 'Sks',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbMengajars()
    {
        return $this->hasMany(Mengajar::className(), ['id_matakuliah' => 'id_matakuliah']);
    }
}
