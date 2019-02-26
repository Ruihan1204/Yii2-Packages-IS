<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Paket;

/**
 * PaketSearch represents the model behind the search form of `backend\models\Paket`.
 */
class PaketSearch extends Paket
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_paket', 'tujuan_paket', 'penerima_paket'], 'integer'],
            [['tanggal_paket', 'jenis_paket', 'pengirim_paket', 'status_paket'], 'safe'],
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
        $query = Paket::find();

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
            'id_paket' => $this->id_paket,
            'tanggal_paket' => $this->tanggal_paket,
            'tujuan_paket' => $this->tujuan_paket,
            'penerima_paket' => $this->penerima_paket,
        ]);

        $query->andFilterWhere(['like', 'jenis_paket', $this->jenis_paket])
            ->andFilterWhere(['like', 'pengirim_paket', $this->pengirim_paket])
            ->andFilterWhere(['like', 'status_paket', $this->status_paket]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @param $id
     * @return ActiveDataProvider
     */
    public function searchUserPacket($params, $id)
    {
        $query = Paket::find()->where('tujuan_paket ='.$id);

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
            'id_paket' => $this->id_paket,
            'tanggal_paket' => $this->tanggal_paket,
            'tujuan_paket' => $this->tujuan_paket,
            'penerima_paket' => $this->penerima_paket,
        ]);

        $query->andFilterWhere(['like', 'jenis_paket', $this->jenis_paket])
            ->andFilterWhere(['like', 'pengirim_paket', $this->pengirim_paket])
            ->andFilterWhere(['like', 'status_paket', $this->status_paket]);

        return $dataProvider;
    }
}
