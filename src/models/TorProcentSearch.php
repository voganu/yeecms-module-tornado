<?php

namespace voganu\tornado\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
//use app\models\TorPrihod;

class TorProcentSearch extends TorProcent
{

    public function search($params)
    {
        $query = TorProcent::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['name'=>SORT_ASC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'name' => $this->name,
            'status_id' => $this->status_id,
        ]);

        return $dataProvider;
    }
}
