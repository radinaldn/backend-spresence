<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Mengajar;

/**
 * MengajarSearch represents the model behind the search form of `app\models\Mengajar`.
 */
class MengajarSearch extends Mengajar
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_mengajar', 'id_matakuliah', 'nip', 'id_kelas', 'id_semester_aktif'], 'integer'],
            [['waktu_mulai'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Mengajar::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_mengajar' => $this->id_mengajar,
            'id_matakuliah' => $this->id_matakuliah,
            'nip' => $this->nip,
            'waktu_mulai' => $this->waktu_mulai,
            'id_kelas' => $this->id_kelas,
            'id_semester_aktif' => $this->id_semester_aktif,
        ]);

        return $dataProvider;
    }
}
