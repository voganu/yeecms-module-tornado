<?php

namespace voganu\tornado\models;

use voganu\tornado\helpers\Helper;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use kartik\builder\TabularForm;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
//use app\models\TorPrihod;

/**
 * TorPrihodSearch represents the model behind the search form of `app\models\TorPrihod`.
 */
class TorPrihodDateVSearch extends TorPrihod
{

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
        $query = TorPrihodDateV::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
//            'sort'=> ['defaultOrder' => ['prihod_date'=>SORT_DESC]]
        ]);
        $dataProvider->setSort([
            'attributes' => [
                'prihod_date' => [
                    'asc' => ['prihod_date' => SORT_ASC],
                    'desc' => ['prihod_date' => SORT_DESC],
                    'default' => SORT_DESC,
                ],
            ],
            'defaultOrder' => [
                'prihod_date'=>SORT_DESC
            ]
        ]);
        $this->load($params);

//        if (!$this->validate()) {
//            // uncomment the following line if you do not want to return any records when validation fails
//            // $query->where('0=1');
//            return $dataProvider;
//        }
        preg_match_all('/\d{2}\/\d{2}\/\d{4}/',$this->prihod_date,$w);
        $w =$w[0];
        if (count($w) == 1 ){
            $date = \DateTime::createFromFormat('d/m/Y', $this->prihod_date);
            $dateForSearch = $date ? $date->format('Y-m-d') : $this->prihod_date;
            $query->andFilterWhere([
                'prihod_date' => $dateForSearch,
            ]);
        }  elseif (count($w) == 2) {
            $date1 = \DateTime::createFromFormat('d/m/Y', $w[0]);
            $dateForSearch1 = $date1 ? $date1->format('Y-m-d') : $w[0];
            $date2 = \DateTime::createFromFormat('d/m/Y', $w[1]);
            $dateForSearch2 = $date2 ? $date2->format('Y-m-d') : $w[1];
            $query->andFilterWhere(['>=', 'prihod_date', $dateForSearch1])
                ->andFilterWhere(['<=', 'prihod_date', $dateForSearch2]);
//            $query->andFilterWhere(['between', 'date', $this->start, $this->end]);
        }
//        $date = \DateTime::createFromFormat('d/m/Y', $this->prihod_date);
//        $dateForSearch = $date ? $date->format('Y-m-d') : $this->prihod_date;
        // grid filtering conditions
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'prihod_date' => $this->prihod_date,
//            'prihod_date' => $dateForSearch
//        ]);


        return $dataProvider;
    }
    public function searchModel($params)
    {
        $query = TorPrihodDateV::find();
//        $query->joinWith(['procent', 'postav', 'rashod']);

        // add conditions that should always apply here


        $this->load($params);

//        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
//            return $dataProvider;
//        }
        $w =str_word_count($this->prihod_date, 1, Helper::DATE_RANGE_SEPARATOR);
        if (count($w) == 1 ){
            $date = \DateTime::createFromFormat('d/m/Y', $this->prihod_date);
            $dateForSearch = $date ? $date->format('Y-m-d') : $this->prihod_date;
            $query->andFilterWhere([
                'prihod_date' => $dateForSearch,
            ]);
        }  elseif (count($w) == 2) {
            $query->andFilterWhere(['>=', 'prihod_date', $w[0]])
                ->andFilterWhere(['<=', 'prihod_date', $w[1]]);
//            $query->andFilterWhere(['between', 'date', $this->start, $this->end]);
        }
//        $date = \DateTime::createFromFormat('d/m/Y', $this->prihod_date);
//        $dateForSearch = $date ? $date->format('Y-m-d') : $this->prihod_date;
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
//            'prihod_date' => $this->prihod_date,
            'prihod_date' => $dateForSearch,
            'prihod_summa' => $this->prihod_summa,
            'procent_id' => $this->procent_id,
            'postav_id' => $this->postav_id,
        ]);

        return $query->one();
    }

}
