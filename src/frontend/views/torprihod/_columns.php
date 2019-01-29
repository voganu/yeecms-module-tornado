<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
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
        'attribute' => 'postav_id',
        'value' => 'postav.name',
        'filter' => false,
//        'filterType' => GridView::FILTER_SELECT2,
//        'filterWidgetOptions' => [
//
//                'data' => \yii\helpers\ArrayHelper::map(\voganu\tornado\models\Postav::find()->all(), 'id', 'name'),
////            'language' => 'ru-RU',
//            'options' => [
//                    'placeholder' => 'укажите поставщика ...'],
//            'pluginOptions' => [
//                'options' =>['id' => 'sdfg'.rand(1,1000)],
//                'allowClear' => true
////                'format' => 'dd/mm/yyyy',
////                'todayHighlight' => true
//            ]
//        ]
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
         'pageSummary' => true,
         'filter' => false
     ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nakl',
        'pageSummary' => false,
        'filter' => false
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => '',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) {
            return Url::to([$action,'id'=>$key]);
        },
        'template' => '{update}',
//        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
//        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete',
//            'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
//            'data-request-method'=>'post',
//            'data-toggle'=>'tooltip',
//            'data-confirm-title'=>'Are you sure?',
//            'data-confirm-message'=>'Are you sure want to delete this item'],
    ],

];
