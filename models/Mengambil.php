<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_mengambil".
 *
 * @property int $id_mengambil
 * @property int $nim
 * @property int $id_mengajar
 *
 * @property Mahasiswa $nim0
 * @property Mengajar $mengajar
 */
class Mengambil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_mengambil';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nim', 'id_mengajar'], 'required'],
            [['nim', 'id_mengajar'], 'integer'],
            [['nim'], 'exist', 'skipOnError' => true, 'targetClass' => Mahasiswa::className(), 'targetAttribute' => ['nim' => 'nim']],
            [['id_mengajar'], 'exist', 'skipOnError' => true, 'targetClass' => Mengajar::className(), 'targetAttribute' => ['id_mengajar' => 'id_mengajar']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_mengambil' => 'Id Mengambil',
            'nim' => 'Nim',
            'id_mengajar' => 'Id Mengajar',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNim0()
    {
        return $this->hasOne(Mahasiswa::className(), ['nim' => 'nim']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMengajar()
    {
        return $this->hasOne(Mengajar::className(), ['id_mengajar' => 'id_mengajar']);
    }
}
