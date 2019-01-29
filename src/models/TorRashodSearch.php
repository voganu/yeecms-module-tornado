<?php

namespace voganu\tornado\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
//use app\models\TorPrihod;

/**
 * TorPrihodSearch represents the model behind the search form of `app\models\TorPrihod`.
 */
class TorRashodSearch extends Rashod
{
    /**
     * {@inheritdoc}
     */

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Rashod::find();
//        $query->joinWith(['procent', 'postav', 'rashod']);

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
//            'prihod_date' => $this->prihod_date,
            'prihod_id' => $this->prihod_id,
        ]);
        return $dataProvider;
    }
}
