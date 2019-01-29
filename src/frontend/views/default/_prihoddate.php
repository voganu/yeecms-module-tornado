<?php
//namespace voganu\tornado\frontend;
use yii\widgets\LinkPager;
//use luya\admin\filters\MediumCrop;
use kartik\grid\GridView;
use kartik\dynagrid\DynaGrid;
use kartik\form\ActiveForm;
use kartik\builder\TabularForm;
use voganu\tornado\helpers\Helper;
/* @var $this \luya\web\View */
/* @var $provider \yii\data\ActiveDataProvider */
use yii\bootstrap\Html;
use kartik\tabs\TabsX;
//use yii\bootstrap\Modal;
//use johnitvn\ajaxcrud\CrudAsset;

//CrudAsset::register($this);

?>
<?php
$columns = [
    ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
//    [
//        'class' => 'kartik\grid\ExpandRowColumn',
//        'width' => '50px',
//        'value' => function ($model, $key, $index, $column) {
//            return GridView::ROW_COLLAPSED;
//        },
//        'detailUrl' => 'tornado/prihod/detail',
//        'headerOptions' => ['class' => 'kartik-sheet-style'],
//        'expandOneOnly' => true
//    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'prihod_date',
        'filterType' => GridView::FILTER_DATE_RANGE ,
        'filterWidgetOptions' => [
            'language' => 'ru-RU',
            'convertFormat'=>true,
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'd/m/Y',
                'locale'=>[
                    'format'=>'d/m/Y',
                    'separator'=> Helper::DATE_RANGE_SEPARATOR,
                ],
                'todayHighlight' => true
            ]
        ]
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'prihod_summa',
        'filter' => false,
        'pageSummary' => true
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'prihod_summa_proc',
        'filter' => false,
        'pageSummary' => true
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'prihod_summa_total',
        'filter' => false,
        'pageSummary' => true
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'rashod_summa',
        'filter' => false,
        'pageSummary' => true
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'dolg',
        'filter' => false,
        'pageSummary' => false
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'vozvrat_dolga',
        'filter' => false,
        'pageSummary' => false
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'kassa',
        'filter' => false,
        'pageSummary' => true
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'terminal',
        'filter' => false,
        'pageSummary' => true
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'kassaterm',
        'filter' => false,
        'pageSummary' => true
    ],
    [
        'class' => '\kartik\grid\ActionColumn',
        'header' => '',
        'template' => '{update}',
        'buttons' => [
            'update' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-th-large"></span>',
                    ['torprihod/index'],
                    [
                        'data-method' => 'POST',
                        'data-params' => [
                            'prihodDate' => $model->prihod_date,
                        ],
                    ]

                    ,
                    [
                        'title' => Yii::t('yii', 'Update'),
                    ]);
            },
        ],
    ],
    [
        'class' => '\kartik\grid\ActionColumn',
        'header' => '',
        'template' => '{view}',
        'buttons' => [
            'view' => function ($url, $model) {
                return Html::a('<span class="glyphicon glyphicon-euro"></span>',
                    ['torprihodmoney/index'],
                    [
                        'data-method' => 'POST',
                        'data-params' => [
                            'prihodDate' => $model->prihod_date,
                        ],
                    ]

                    ,
                    [
                        'title' => 'подробней приход деньги',
                    ]);
            },
        ],
    ],

//    [
//        'attribute' => 'procent_id',
//        'value' => function($data){
//            return $data->procent_name;
//        },//        'value' => 'procent.name'
//    ],
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
//    '{export}',
//    '{toggleData}'
];
?>
<div class="clearfix">
    <div>
    <div class="pull-right">
            <div class="btn-group">
                <?=                            Html::a('по поставщикам', ['torprihod/group'],
                    [
                        'class'=>'btn btn-primary'])
                ?>
            <?=                            Html::a('поставщики', ['torpostav/index'],
                [
                    'id' =>'new', 'role'=>'modal-remote','title'=> 'Приход товар','class'=>'btn btn-default'])
            .' '.
            Html::a('проценты', ['torprocent/index'],
                [


                    'id' =>'new', 'role'=>'modal-remote','title'=> 'Приход деньги','class'=>'btn btn-default'])
            ?>
        </div>
        </div>
        <h4 class="pull-left">Магазин</h4>
    </div>

</div>
<br>
<div>
    <?php
            $dynagrid = DynaGrid::begin([
                'columns' => $columns,
                'theme'=>'panel-primary',
//                'showPersonalize'=>true,
//                'storage' => 'session',
                'gridOptions'=>[
                    'dataProvider'=>$dataProvider,
                    'filterModel'=>$searchModel,
                    'showPageSummary'=>true,
                    'floatHeader'=>true,
                    'pjax'=>true,
                    'pjaxSettings'=>[
                        'neverTimeout'=>true,
//                        'options'=>['id' => 'table-prihod'],
                    ],
                    'responsiveWrap'=>false,
                    'panel'=>[
//                        'heading'=>'<h3 class="panel-title"><i class="fas fa-book"></i>  Library</h3>',
//                        'before' =>  '<div style="padding-top: 7px;"><em>* The table header sticks to the top in this demo as you scroll</em></div>',
//                        'after' => false
                    ],
                    'toolbar'=> [
                        ['content'=>
                            Html::a('<i class="glyphicon glyphicon-th-large"></i>', ['torprihod/index'],
                                [

                                        'data-method' => 'POST',
                                        'data-params' => [
//                                        'prihodDate' => null,
                                        ],


                                        'id' =>'new', 'role'=>'modal-remote','title'=> 'Приход товар','class'=>'btn btn-success'])
                            .' '.
                            Html::a('<i class="glyphicon glyphicon-euro"></i>', ['torprihodmoney/index'],
                                [

                                    'data-method' => 'POST',
                                    'data-params' => [
//                                        'prihodDate' => null,
                                    ],


                                    'id' =>'new', 'role'=>'modal-remote','title'=> 'Приход деньги','class'=>'btn btn-warning'])
//                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
//                        ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
//                    '{toggleData}'.
//                    '{export}'
                        ],
                    ],

//                    'toolbar' =>  [
//                        ['content'=>
////                            Html::a('<i class="glyphicon glyphicon-plus"></i> новый приход', ['dynagrid-demo'], ['data-pjax'=>0, 'class' => 'btn btn-outline-secondary', 'title'=>'Reset Grid']),
//                            Html::a('<i class="glyphicon glyphicon-plus"></i>', [
//                            ['create'],
//                                                                [
//                                    'data-method' => 'POST',
//                                    'data-params' => [
////                                        'prihodDate' => null,
//                                    ],
//                                ],
//
//                            ],
//                                ['id' =>'new', 'role'=>'modal-remote','title'=> 'Create new Tor Prihods','class'=>'btn btn-success'])
//
////                            Html::a('<i class="glyphicon glyphicon-plus"></i>', ['torprihod/index'],
////                                [
////                                    'data-method' => 'POST',
////                                    'data-params' => [
//////                                        'prihodDate' => null,
////                                    ],
////                                ],
////                                ['role'=>'modal-remote','title'=> 'Create new Tor Prihods','class'=>'btn btn-default'])
////                            Html::button('в начало', ['type'=>'button', 'title'=>'в начало', 'class'=>'btn btn-default'])
////                            Html::a('<i class="fa  fa-repeat"></i>', ['dynagrid-demo'], ['data-pjax'=>0, 'class' => 'btn btn-outline-secondary', 'title'=>'Reset Grid'])
//                        ],
////                        ['content'=>'{dynagridFilter}{dynagridSort}{dynagrid}'],
//                        '{export}',
//                    ]
                ],
                'options'=>['id'=>'dynagrid-prihod'] // a unique identifier is important
            ]);
            if (substr($dynagrid->theme, 0, 6) == 'simple') {
                $dynagrid->gridOptions['panel'] = false;
            }
            DynaGrid::end();
            ?>

    </div>
<?php //Modal::begin([
//    "id"=>"ajaxCrudModal",
//    "footer"=>"",// always need it for jquery plugin
//])?>
<?php //Modal::end(); ?>

<?php

//$this->registerJs(
//    '
//function init_click_handlers(){
//  $("body").on("click",".prihod-update",function(event) {
//        event.preventDefault();
//     $(\'#detail\').modal(\'show\')
//         .find(\'.modal-body\')
//         .load($(this).attr(\'href\'));
//        });
//}
//init_click_handlers(); //first run
//$("#prihod-grid-pjax").on("pjax:success", function() {
//  init_click_handlers(); //reactivate links in grid after pjax update
//});
//$(\'#detail\').on(\'hidden.bs.modal\', function(e)
//    {
//        $(this).removeData();
//    }) ;
//
//$(\'form\').on(\'beforeSubmit\', function(e) {
//
//    var form = $(this);
//
//    var formData = form.serialize();
//
//    $.ajax({
//
//        url: form.attr("action"),
//
//        type: form.attr("method"),
//
//        data: formData,
//
//        success: function (data) {
//
//             ...
//
//        },
//
//        error: function () {
//
//            alert("Something went wrong");
//
//        }
//
//    });
//
//}).on(\'submit\', function(e){
//
//    e.preventDefault();
//
//});
//
//', \yii\web\View::POS_END);
?>




