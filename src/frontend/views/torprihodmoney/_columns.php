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
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'kassa',
        'pageSummary' => true,
        'filter' => false
    ],
     [
     'class'=>'\kartik\grid\DataColumn',
     'attribute'=>'terminal',
         'pageSummary' => true,
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
