<?php

namespace voganu\tornado\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
//use app\models\TorPrihod;

/**
 * TorPrihodSearch represents the model behind the search form about `app\models\TorPrihod`.
 */
class TorPrihodMoneySearch extends TorPrihodMoney
{
    /**
     * @inheritdoc
     */
//    public function rules()
//    {
//        return [
//            [['kassa', 'terminal'], 'number'],
//            [['kassa', 'terminal'], 'safe'],
//        ];
//    }

    /**
     * @inheritdoc
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
        $query = TorPrihodMoney::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['prihod_date'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $date = \DateTime::createFromFormat('d/m/Y', $this->prihod_date);
        $dateForSearch = $date ? $date->format('Y-m-d') : $this->prihod_date;

        $query->andFilterWhere([
            'id' => $this->id,
            'prihod_date' => $dateForSearch,
            'kassa' => $this->kassa,
            'terminal' => $this->terminal,
        ]);


        return $dataProvider;
    }
}
