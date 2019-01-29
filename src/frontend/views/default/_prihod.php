<?php
use yii\widgets\LinkPager;
use luya\admin\filters\MediumCrop;
use kartik\grid\GridView;
use kartik\dynagrid\DynaGrid;
use kartik\form\ActiveForm;
use kartik\builder\TabularForm;
/* @var $this \luya\web\View */
/* @var $provider \yii\data\ActiveDataProvider */
use yii\bootstrap\Html;
use kartik\tabs\TabsX;
?>
<?php
$columns = [
    ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
    [
        'class' => 'kartik\grid\ExpandRowColumn',
        'width' => '50px',
        'value' => function ($model, $key, $index, $column) {
            return GridView::ROW_COLLAPSED;
        },
        'detailUrl' => 'rashod_detail',
//        'detail' => function ($model, $key, $index, $column) {
//            return Yii::$app->controller->renderPartial('_rashod', ['model' => $model]);
//        },
        'headerOptions' => ['class' => 'kartik-sheet-style'],
        'expandOneOnly' => true
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'prihod_date',
        'format' => ['date','php:d/m/Y'],
        'filterType' => GridView::FILTER_DATE,
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
        'attribute' => 'prihod_summa',
        'pageSummary' => true
    ],
//    [
//        'attribute' => 'procent_id',
//        'value' => function($data){
//            return $data->procent_name;
//        },//        'value' => 'procent.name'
//    ],
    [
        'attribute' => 'postav_id',
//        'value' => 'postav_name',
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'data' => \yii\helpers\ArrayHelper::map(\voganu\tornado\models\Postav::find()->all(), 'id', 'name'),
//            'language' => 'ru-RU',
            'options' => ['placeholder' => 'укажите поставщика ...'],
            'pluginOptions' => [
                'allowClear' => true
//                'format' => 'dd/mm/yyyy',
//                'todayHighlight' => true
            ]
        ]
    ],
        [
            'class' => '\kartik\grid\ActionColumn',
            'buttons' => [
                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                        'class' => 'pjax-update-link',
                        'title' => Yii::t('yii', 'Update'),
                        'update-url' => $url
                    ]);
                },
                    //                'viewOptions' => [
//                    'options' => array(  // set all kind of html options in here
//                        'onclick' =>"js:$('a[data-tab=\"prihodupdate-tab\"]').tab('show');",
//                        'style' => 'font-weight: bold',
//                    ),
//                ],
                    //                'view' => function ($url, $model, $key) {
//                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>','#', [
//                        'id' => 'activity-view-link',
//                        'title' => Yii::t('yii', 'View'),
//                        'data-toggle' => 'modal',
//                        'data-target' => '#a[data-tab="prihod-tab"]',
//                        'data-id' => $key,
//                        'data-pjax' => '0',
//
//                    ]);
//                },
            ],
            'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>']
        ]
];
$toolbar = [
    [
        'content'=>
            \yii\bootstrap\Html::button('<i class="glyphicon glyphicon-plus"></i>', [
                'type'=>'button',
                'title'=>Yii::t('kvgrid', 'Add Book'),
                'class'=>'btn btn-success'
            ])
        //. ' '.
//            \yii\bootstrap\Html::a('<i class="fas fa-redo"></i>', ['grid-demo'], [
//                'class' => 'btn btn-secondary',
//                'title' => Yii::t('kvgrid', 'Reset Grid')
//            ]),
    ],
    '{export}',
    '{toggleData}'
];
?>

<div>
    <button id="aa">sdfgdg</button>
    <?php
            $dynagrid = DynaGrid::begin([
                'columns' => $columns,
                'theme'=>'panel-info',
//                'showPersonalize'=>true,
//                'storage' => 'session',
                'gridOptions'=>[
                    'dataProvider'=>$dataProvider,
                    'filterModel'=>$searchModel,
                    'showPageSummary'=>true,
                    'floatHeader'=>true,
                    'pjax'=>false,
                    'pjaxSettings'=>[
//                        'neverTimeout'=>true,
//                        'options'=>['id' => 'table-prihod'],
                    ],
                    'responsiveWrap'=>false,
                    'panel'=>[
//                        'heading'=>'<h3 class="panel-title"><i class="fas fa-book"></i>  Library</h3>',
//                        'before' =>  '<div style="padding-top: 7px;"><em>* The table header sticks to the top in this demo as you scroll</em></div>',
//                        'after' => false
                    ],
                    'toolbar' =>  [
                        ['content'=>
                            Html::button('<i class="fa fa-plus"></i>', ['type'=>'button', 'title'=>'Add Book', 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
                            Html::a('<i class="fa  fa-repeat"></i>', ['dynagrid-demo'], ['data-pjax'=>0, 'class' => 'btn btn-outline-secondary', 'title'=>'Reset Grid'])
                        ],
                        ['content'=>'{dynagridFilter}{dynagridSort}{dynagrid}'],
                        '{export}',
                    ]
                ],
                'options'=>['id'=>'dynagrid-prihod'] // a unique identifier is important
            ]);
            if (substr($dynagrid->theme, 0, 6) == 'simple') {
                $dynagrid->gridOptions['panel'] = false;
            }
            DynaGrid::end();
            ?>

    </div>

<?php

//$this->registerJs(
//  "
////  $('a[data-tab=\"prihod-tab\"]').on('shown.bs.tab', function (e) {
////            $.pjax.reload({container:'#dynagrid-prihod-pjax'});
////            console.log( e.target) // newly activated tab
////            e.relatedTarget // previous active tab
////        })
////    function toUpdate(id){
////    $('a#prihodupdate_tab').tab('show');
////    $( 'a#prihodupdate_tab' ).click(function( event ) {
////        event.preventDefault();
////    }
//        $('.pjax-update-link').on('click', function(e) {
//            e.preventDefault();
//            $('a[data-tab=\"prihodupdate-tab\"]').tab('show');
//            var updateUrl = $(this).attr('update-url');
//                $.ajax({
//                    url: updateUrl,
//                    type: 'post',
//                    error: function(xhr, status, error) {
//                        alert('There was an error with your request.' + xhr.responseText);
//                    }
//                }).done(function(data) {
//                        $(\"#prihodupdate\").html(data);
////                    $('a[data-tab=\"prihodupdate-tab\"]').tab('show');
////                    $.pjax.reload('#' + $.trim(pjaxContainer), {timeout: 3000});
//                });
//
//});
//",
////"    $('div.tabs-x .nav-tabs [data-toggle=\"tab\"]').on('tabsX:click', function (event) {
////        console.log('tabsX:click event');
////    });
////",
//    \yii\web\View::POS_READY,
//    'my-button-handler'
//);

//$this->registerJs("
//    $(document).on('ready', function() {
//        $('.pjax-update-link').on('click', function(e) {
//            e.preventDefault();
//            alert('11');
//            e.stopPropagation();
//                    $('a[data-tab=\"prihodupdate-tab\"]').tab('show');

//            var updateUrl = $(this).attr('update-url');
//                $.ajax({
//                    url: updateUrl,
//                    type: 'post',
//                    error: function(xhr, status, error) {
//                        alert('There was an error with your request.' + xhr.responseText);
//                    }
//                }).done(function(data) {
//                    $('a[data-tab=\"prihodupdate-tab\"]').tab('show');
//                    $.pjax.reload('#' + $.trim(pjaxContainer), {timeout: 3000});
//                });
//        });
//
//    });
//");
?>




