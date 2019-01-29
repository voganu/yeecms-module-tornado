<?php

namespace voganu\tornado\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use kartik\builder\TabularForm;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
//use app\models\TorPrihod;

/**
 * TorPrihodSearch represents the model behind the search form of `app\models\TorPrihod`.
 */
class TorPrihodSearch extends TorPrihod
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'procent_id', 'postav_id'], 'integer'],
            [['prihod_date', 'nakl', 'postav_id'], 'safe'],
            [['prihod_summa'], 'number'],
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
        $query = TorPrihod::find();
        $query->joinWith(['procent', 'postav']);

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
        $date = \DateTime::createFromFormat('d/m/Y', $this->prihod_date);
        $dateForSearch = $date ? $date->format('Y-m-d') : $this->prihod_date;
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
//            'prihod_date' => $this->prihod_date,
            'prihod_date' => $dateForSearch,
            'prihod_summa' => $this->prihod_summa,
            'procent_id' => $this->procent_id,
            'postav_id' => $this->postav_id,
        ]);

        $query->andFilterWhere(['like', 'nakl', $this->nakl]);

        return $dataProvider;
    }
    public function searchModel($params)
    {
        $query = TorPrihod::find();
        $query->joinWith(['procent', 'postav', 'rashod']);

        // add conditions that should always apply here


        $this->load($params);

//        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
//            return $dataProvider;
//        }
        $date = \DateTime::createFromFormat('d/m/Y', $this->prihod_date);
        $dateForSearch = $date ? $date->format('Y-m-d') : $this->prihod_date;
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
//            'prihod_date' => $this->prihod_date,
            'prihod_date' => $dateForSearch,
            'prihod_summa' => $this->prihod_summa,
            'procent_id' => $this->procent_id,
            'postav_id' => $this->postav_id,
        ]);

        $query->andFilterWhere(['like', 'nakl', $this->nakl]);

        return $query->one();
    }

    public function getFormAttribs() {
        return [
//            [
//                'class' => 'kartik\grid\ExpandRowColumn',
//                'width' => '50px',
//                'value' => function ($model, $key, $index, $column) {
//                    return GridView::ROW_COLLAPSED;
//                },
//                'detailUrl' => 'rashod_detail',
////        'detail' => function ($model, $key, $index, $column) {
////            return Yii::$app->controller->renderPartial('_rashod', ['model' => $model]);
////        },
//                'headerOptions' => ['class' => 'kartik-sheet-style'],
//                'expandOneOnly' => true
//            ],
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>TabularForm::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            'prihod_date'=>[
                'type' => function($model, $key, $index, $widget) {
                    return ($key % 2 === 0) ? TabularForm::INPUT_HIDDEN : TabularForm::INPUT_WIDGET;
                },
                'widgetClass'=>\kartik\widgets\DatePicker::class,
                'options'=> function($model, $key, $index, $widget) {
                    return ($key % 2 === 0) ? [] :
                        [
                            'pluginOptions'=>[
                                'format'=>'dd/mm/yyyy',
                                'todayHighlight'=>true,
                                'autoclose'=>true
                            ]
                        ];
                },
                'columnOptions'=>['width'=>'170px']
            ],

            'postav_id'=>[
                'type'=>TabularForm::INPUT_DROPDOWN_LIST,
                'items'=>ArrayHelper::map(Postav::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'columnOptions'=>['width'=>'185px']
            ],
            'procent_id'=>[
                'type'=>TabularForm::INPUT_DROPDOWN_LIST,
                'items'=>ArrayHelper::map(Procent::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'columnOptions'=>['width'=>'185px']
            ],
            /*
            'buy_amount'=>[
                'type'=>TabularForm::INPUT_TEXT,
                'label'=>'Buy',
                'options'=>['class'=>'form-control text-right'],
                'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
            ],
            */
            'prihod_summa'=>[
                'type'=>TabularForm::INPUT_TEXT,
//                'label'=>'Sell',
                'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
            ],
            'rashod_summa'=>[
                'type'=>TabularForm::INPUT_TEXT,
//                'label'=>'Sell',
                'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
            ],
        ];
    }
}
