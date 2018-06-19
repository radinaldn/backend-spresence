<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PresensiDetail;

/**
 * PresensiDetailSearch represents the model behind the search form of `app\models\PresensiDetail`.
 */
class PresensiDetailSearch extends PresensiDetail
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_presensi', 'status', 'waktu'], 'safe'],
            [['nim', 'jarak'], 'integer'],
            [['lat', 'lng'], 'number'],
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
        $query = PresensiDetail::find();

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
            'nim' => $this->nim,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'waktu' => $this->waktu,
            'jarak' => $this->jarak,
        ]);

        $query->andFilterWhere(['like', 'id_presensi', $this->id_presensi])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
