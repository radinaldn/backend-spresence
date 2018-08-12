<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Mengambil;

/**
 * MengambilSearch represents the model behind the search form of `app\models\Mengambil`.
 */
class MengambilSearch extends Mengambil
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_mengambil', 'id_mengajar'], 'safe'],
            [['nim'], 'integer'],
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
        $query = Mengambil::find();

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
        ]);

        $query->andFilterWhere(['like', 'id_mengambil', $this->id_mengambil])
            ->andFilterWhere(['like', 'id_mengajar', $this->id_mengajar]);

        return $dataProvider;
    }
}
