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
        'attribute' => 'name',
        'filter' => false
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
        'attribute' => 'description',
        'filter' => false
//        'value' => function($data){
//            return $data->procent_name;
//        },//        'value' => 'procent.name'
    ],
    [
        'attribute' => 'status_id',
        'value' => 'status.name',
        'filter' => false
//        'value' => function($data){
//            return $data->procent_name;
//        },//        'value' => 'procent.name'
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
