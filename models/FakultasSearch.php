<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Fakultas;

/**
 * FakultasSearch represents the model behind the search form of `app\models\Fakultas`.
 */
class FakultasSearch extends Fakultas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_fakultas'], 'integer'],
            [['nama'], 'safe'],
            [['titik_a_lat', 'titik_a_lng', 'titik_b_lat', 'titik_b_lng', 'titik_c_lat', 'titik_c_lng', 'titik_d_lat', 'titik_d_lng'], 'number'],
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
        $query = Fakultas::find();

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
            'id_fakultas' => $this->id_fakultas,
            'titik_a_lat' => $this->titik_a_lat,
            'titik_a_lng' => $this->titik_a_lng,
            'titik_b_lat' => $this->titik_b_lat,
            'titik_b_lng' => $this->titik_b_lng,
            'titik_c_lat' => $this->titik_c_lat,
            'titik_c_lng' => $this->titik_c_lng,
            'titik_d_lat' => $this->titik_d_lat,
            'titik_d_lng' => $this->titik_d_lng,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama]);

        return $dataProvider;
    }
}
