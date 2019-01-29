<?php
use kartik\grid\GridView;
use kartik\detail\DetailView;
use igorvolnyi\widgets\modal\ModalAjaxMultiple;
?>
<?php
//echo ModalAjaxMultiple::widget([
//    'id' => 'updatePrihod',
//    'selector' => 'a.prihod-update', // all buttons in grid view with href attribute
//    'ajaxSubmit' => true, // Submit the contained form as ajax, true by default
//
//    'options' => ['class' => 'header-primary'],
//    'pjaxContainer' => '#torprihod-pjax',
//    'events'=>[
//    ModalAjaxMultiple::EVENT_MODAL_SHOW => new \yii\web\JsExpression("
//            function(event, data, status, xhr, selector) {
//                selector.addClass('warning');
//            }
//       "),
//    ModalAjaxMultiple::EVENT_MODAL_SUBMIT => new \yii\web\JsExpression("
//            function(event, data, status, xhr, selector) {
//                if(status){
//                    if(selector.data('scenario') == 'hello'){
//                        alert('hello');
//                    } else {
//                        alert('goodbye');
//                    }
//                    $(this).modal('toggle');
//                }
//            }
//        ")
//]

//]);

?>
<?php
//yii\bootstrap\Modal::begin();
$columns = [
    ['class'=>'kartik\grid\SerialColumn'],
//    [
//        'class' => 'kartik\grid\ExpandRowColumn',
//        'width' => '50px',
//        'value' => function ($model, $key, $index, $column) {
//            return GridView::ROW_COLLAPSED;
//        },
//        'detailUrl' => 'rashod_detail',
////        'detail' => function ($model, $key, $index, $column) {
////            return Yii::$app->controller->renderPartial('_rashod', ['model' => $model]);
////        },
//        'headerOptions' => ['class' => 'kartik-sheet-style'],
//        'expandOneOnly' => true
//    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'prihod_date',
        'format' => ['date','php:d/m/Y'],
        'filterType' => GridView::FILTER_DATE,
        'filterWidgetOptions' => [
            'language' => 'ru-RU',
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd/mm/yyyy',
                'todayHighlight' => true
            ]
        ]
    ],
    [
        'attribute' => 'postav_id',
        'value' => 'postav.name',
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
        'attribute' => 'procent_id',
        'value' => 'procent.name',
        'filter' => false
//        'value' => function($data){
//            return $data->procent_name;
//        },//        'value' => 'procent.name'
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'prihod_summa',
        'pageSummary' => true,
        'filter' => false
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'rashod_summa',
        'pageSummary' => true,
        'filter' => false
    ],
    [
        'class' => '\kartik\grid\ActionColumn',
        'template' => '{update}',
        'buttons' => [
            'update' => function($url, $model, $key) {
                $link = \yii\helpers\Html::a('изменить', ['update', 'id' => $model->id], [
                    'title' => 'asfas',
                    'class' => 'prihod-update',
                    'data' => [
                        'key' => $model->id,
//                        'target' => '#detail',
//                        'toggle' => 'modal',
//                        'backdrop' => 'static',
                    ]
                ]);
                return $link;
    //                return \yii\helpers\Html::button('Р', ['value'=> $url,
//                    'class' => 'btn-update',
//                    'data-pjax' => '0']);
            },
//                'update' => function ($url, $model) {
//                return \yii\helpers\Html::a('изменить',
//                    $url,
////                    \yii\helpers\Url::to(['prihod/update', 'id='=>$model->id]),
//                    [
//                        'class' => 'pjax-update-link',
//                        'title' => Yii::t('yii', 'Update'),
//                        'update-url' => $url
//                    ]);
//            },
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
<!--<div class="col-md-1"></div>-->
<!--<div class="col-md-9">-->
<?php
    $prihodgrid = GridView::begin([
       'columns' => $columns,
//        'theme'=>'panel-info',
//                'showPersonalize'=>true,
//                'storage' => 'session',
//        'gridOptions'=>[
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
//        'filterModel'=>false,
        'showPageSummary'=>true,
//            'floatHeader'=>true,
        'pjax'=>true,
        'pjaxSettings'=>[
//                        'neverTimeout'=>true,
           'options'=>['id' => 'torprihod-pjax'],
        ],
        'responsiveWrap'=>false,
        'panel'=>[
                'type' => GridView::TYPE_PRIMARY,
                'heading'=>'<h2 class="panel-title">Приход</h2>',
                        'before' =>  '<div style="padding-top: 7px;"><em>* The table header sticks to the top in this demo as you scroll</em></div>',
//                        'after' => false
        ],
        'toolbar' =>  [
            ['content'=>
                \yii\helpers\Html::button('новый приход', ['type'=>'button', 'title'=>'новый приход', 'class'=>'btn btn-success'])
//                . ' '.
//                \yii\helpers\Html::button('в начало', ['type'=>'button', 'title'=>'в начало', 'class'=>'btn btn-default'])
            ],
//                ['content'=>'{dynagridFilter}{dynagridSort}{dynagrid}'],
            '{export}',
        ],
//        ],
        'options'=>['id'=>'prihod-grid'] // a unique identifier is important
    ]);
//    if (substr($dynagrid->theme, 0, 6) == 'simple') {
//        $dynagrid->gridOptions['panel'] = false;
//    }
    GridView::end();
    ?>

<!--</div>-->
<?php
//\yii\bootstrap\Modal::begin([
//    'header'=>'<h4>Job Created</h4>',
//    'id'=>'modal',
//    'size'=>'modal-lg',
//]);
//
//echo "<div id='modalContent'></div>";
//\yii\bootstrap\Modal::end();
$settings = [
    'mode' =>DetailView::MODE_EDIT,
//    'model' => $model
];
\yii\bootstrap\Modal::begin([
    'id' => 'detail',
        'header' => '<h4 class="modal-title">Detail View Demo</h4>',
//    'toggleButton' => ['label' => '<i class="glyphicon glyphicon-th-list"></i> Detail View in Modal', 'class' => 'btn btn-primary'],
    'options' => ['tabindex' => false]
]);
//echo \kartik\detail\DetailView::widget($settings); // refer the demo page for widget settings
\yii\bootstrap\Modal::end();

?>

<?php
//use kartik\widgets\ActiveForm;
//use kartik\builder\TabularForm;
//?>
<!--<div>-->
<!--        <div class="col-md-1"></div>-->
<!--        <div class="col-md-9">-->
<!---->
<?php
//$form = ActiveForm::begin();
//echo TabularForm::widget([
//    'dataProvider'=>$dataProvider,
//    'form'=>$form,
//    'attributes'=>$searchModel->formAttribs
//]);
//ActiveForm::end();
//?>
<!--        </div>-->
<!--</div>-->
