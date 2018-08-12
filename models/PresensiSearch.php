<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Presensi;

/**
 * PresensiSearch represents the model behind the search form of `app\models\Presensi`.
 */
class PresensiSearch extends Presensi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_presensi', 'id_mengajar', 'pertemuan', 'id_ruangan', 'waktu', 'qr_code'], 'safe'],
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
        $query = Presensi::find();

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
            'waktu' => $this->waktu,
        ]);

        $query->andFilterWhere(['like', 'id_presensi', $this->id_presensi])
            ->andFilterWhere(['like', 'id_mengajar', $this->id_mengajar])
            ->andFilterWhere(['like', 'pertemuan', $this->pertemuan])
            ->andFilterWhere(['like', 'id_ruangan', $this->id_ruangan])
            ->andFilterWhere(['like', 'qr_code', $this->qr_code]);

        return $dataProvider;
    }
}
