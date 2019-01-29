<?php

namespace voganu\tornado\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
//use app\models\TorPrihod;

/**
 * TorPrihodSearch represents the model behind the search form about `app\models\TorPrihod`.
 */
class TorPrihodSearch extends TorPrihod
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'procent_id', 'postav_id'], 'integer'],
            [['prihod_date', 'nakl'], 'safe'],
            [['prihod_summa', 'rashod_summa'], 'number'],
        ];
    }

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
        $query = TorPrihod::find();
        $query->joinWith(['postav', 'procent']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
//            'sort'=> ['defaultOrder' => ['prihod_date'=>SORT_DESC]]
        ]);
        $dataProvider->setSort([
            'attributes' => [
                'postav_id' => [
                    'asc' => ['tor_postav.name' => SORT_ASC],
                    'desc' => ['tor_postav.name' => SORT_DESC],
                    'default' => SORT_ASC
                ],
//                'prihod_date' => [
//                    'asc' => ['prihod_date' => SORT_ASC],
//                    'desc' => ['prihod_date' => SORT_DESC],
//                    'default' => SORT_DESC,
//                ],
            ],
            'defaultOrder' => [
                'postav_id'=>SORT_ASC
            ]
        ]);
//        $dataProvider->sort->attributes['postav_id'] = [
//            // The tables are the ones our relation are configured to
//            // in my case they are prefixed with "tbl_"
//            'asc' => ['postav.name' => SORT_ASC],
//            'desc' => ['postav.name' => SORT_DESC],
//        ];

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
            'prihod_summa' => $this->prihod_summa,
            'procent_id' => $this->procent_id,
            'postav_id' => $this->postav_id,
            'rashod_summa' => $this->rashod_summa,
        ]);

        $query->andFilterWhere(['like', 'nakl', $this->nakl]);

        return $dataProvider;
    }
}
