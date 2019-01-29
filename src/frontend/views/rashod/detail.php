<?php
use kartik\grid\GridView;
?>
<?php
$columns = [
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'rashod_date',
        'format' => ['date','php:d/m/Y'],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'rashod_summa',
        'pageSummary' => true
    ],
];
?>
<?php
    echo GridView::widget([
    'dataProvider'=> $dataProvider,
//    'filterModel' => $searchModel,
    'pjax'=>true,
        'showPageSummary' => true,
//    'columns' => $gridColumns,
    'responsive'=>true,
    'hover'=>true,
        'columns' => $columns
    ]);
?>
