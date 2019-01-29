<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'attribute' => 'postav_id',
        'width' => '310px',
        'value' => 'postav.name',
        'filterType' => \kartik\grid\GridView::FILTER_SELECT2,
        'filter' => \yii\helpers\ArrayHelper::map(\voganu\tornado\models\TorPostav::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'поставщик'],
        'group' => true,  // enable grouping
        'groupFooter' => function ($model, $key, $index, $widget) { // Closure method
            return [
                'mergeColumns' => [[1,2]], // columns to merge in summary
                'content' => [             // content to show in each summary cell
                    1 => 'Итого  (' . $model->postav->name . ')',
//                    4 => GridView::F_AVG,
                    3 => \kartik\grid\GridView::F_SUM,
                    4 => \kartik\grid\GridView::F_SUM,
                    5 => \kartik\grid\GridView::F_SUM,
                    6 => \kartik\grid\GridView::F_SUM,
                ],
                'contentFormats' => [      // content reformatting for each summary cell
                    3 => ['format' => 'number', 'decimals' => 2],
                    4 => ['format' => 'number', 'decimals' => 2],
                    5 => ['format' => 'number', 'decimals' => 0],
                    6 => ['format' => 'number', 'decimals' => 2],
                ],
                'contentOptions' => [      // content html attributes for each summary cell
                    1 => ['style' => 'font-variant:small-caps'],
                    3 => ['style' => 'text-align:right'],
                    4 => ['style' => 'text-align:right'],
                    5 => ['style' => 'text-align:right'],
                    6 => ['style' => 'text-align:right'],
                ],
                // html attributes for group summary row
                'options' => ['class' => 'info table-info','style' => 'font-weight:bold;']
            ];
        }
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'prihod_date',
//        'format' => ['date','php:d/m/Y'],
        'filter' => false,
        'filterType' => \kartik\grid\GridView::FILTER_DATE,
        'filterWidgetOptions' => [
            'language' => 'ru-RU',
            'pluginOptions' => [
                'format' => 'dd/mm/yyyy',
                'todayHighlight' => true
            ]
        ]
    ],
    [
//        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'prihod_summa',
        'contentOptions' => ['class' => 'text-right'],
        'pageSummary' => true,
        'filter' => false
    ],
    [
//        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'prihod_summa_proc',
        'contentOptions' => ['class' => 'text-right'],
        'pageSummary' => true,
        'filter' => false
    ],
    [
//        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'prihod_summa_total',
        'contentOptions' => ['class' => 'text-right'],
        'pageSummary' => true,
        'filter' => false
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'rashod_summa',
        'contentOptions' => ['class' => 'text-right'],
        'pageSummary' => true,
        'filter' => false
    ],
    [
        'attribute' => 'dolg',
//        'format' => 'raw',
        'contentOptions' => ['class' => 'text-right'],
        'value' => function ($model) {
            return $model->dolg;
        },
    ],
     [
     'class'=>'\kartik\grid\DataColumn',
     'attribute'=>'vozvrat_dolga',
         'contentOptions' => ['class' => 'text-right'],
         'pageSummary' => false,
         'filter' => false
     ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nakl',
        'pageSummary' => false,
        'filter' => false
    ],
];
