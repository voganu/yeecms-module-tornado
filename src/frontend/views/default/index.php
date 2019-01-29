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
    [
        'attribute' => 'procent_id',
        'value' => function($data){
            return $data->procent_name;
        },//        'value' => 'procent.name'
    ],
//    [
//        'attribute' => 'postav_id',
//        'value' => 'postav.name',
//        'filterType' => GridView::FILTER_SELECT2,
//        'filterWidgetOptions' => [
//            'data' => \yii\helpers\ArrayHelper::map(\voganu\tornado\models\Postav::find()->all(), 'id', 'name'),
////            'language' => 'ru-RU',
//            'options' => ['placeholder' => 'укажите поставщика ...'],
//            'pluginOptions' => [
//                'allowClear' => true
////                'format' => 'dd/mm/yyyy',
////                'todayHighlight' => true
//            ]
//        ]
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
    '{export}',
    '{toggleData}'
];
?>

<div>

    <?php
//    echo TabsX::widget([
//        'items'=>$items,
//        'position'=>TabsX::POS_ABOVE,
//        'encodeLabels'=>false
//    ]);
    ?>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#prihod" aria-controls="home" role="tab" data-toggle="tab" data-tab = "prihod-tab">Prihod</a></li>
        <li role="presentation"><a href="#prihod-tab" aria-controls="messages" role="tab" data-toggle="tab">Новый приход</a></li>
        <li role="presentation"><a href="#prihodupdate" aria-controls="profile" role="tab" data-toggle="tab" data-tab = "prihodupdate-tab">Update</a></li>
        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <br>
        <div role="tabpanel" class="tab-pane active" id="prihod">
            <?php
//                echo $this->renderAjax('_prihoddate', [
//                    'searchModel' => $searchModel,
//                    'dataProvider' => $dataProvider,
//                ]);
            //            $dynagrid = DynaGrid::begin([
//                'columns' => $columns,
//                'theme'=>'panel-info',
////                'showPersonalize'=>true,
////                'storage' => 'session',
//                'gridOptions'=>[
//                    'dataProvider'=>$dataProvider,
//                    'filterModel'=>$searchModel,
//                    'showPageSummary'=>true,
//                    'floatHeader'=>true,
//                    'pjax'=>true,
//                    'responsiveWrap'=>false,
//                    'panel'=>[
////                        'heading'=>'<h3 class="panel-title"><i class="fas fa-book"></i>  Library</h3>',
////                        'before' =>  '<div style="padding-top: 7px;"><em>* The table header sticks to the top in this demo as you scroll</em></div>',
////                        'after' => false
//                    ],
//                    'toolbar' =>  [
//                        ['content'=>
//                            Html::button('<i class="fa fa-plus"></i>', ['type'=>'button', 'title'=>'Add Book', 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
//                            Html::a('<i class="fa  fa-repeat"></i>', ['dynagrid-demo'], ['data-pjax'=>0, 'class' => 'btn btn-outline-secondary', 'title'=>'Reset Grid'])
//                        ],
//                        ['content'=>'{dynagridFilter}{dynagridSort}{dynagrid}'],
//                        '{export}',
//                    ]
//                ],
//                'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
//            ]);
//            if (substr($dynagrid->theme, 0, 6) == 'simple') {
//                $dynagrid->gridOptions['panel'] = false;
//            }
//            DynaGrid::end();
            //                echo GridView::widget([
//                'dataProvider'=> $dataProvider,
//                'filterModel' => $searchModel,
//                'pjax'=>true,
//                    'showPageSummary' => true,
//            //    'columns' => $gridColumns,
//                'responsive'=>true,
//                'hover'=>true,
//                    'bordered' =>false,
//                    'columns' => $columns,
//                    'panel' => [
//                        'type' => GridView::TYPE_PRIMARY,
//            //            'heading' => $heading,
//                    ],
//                'toolbar' =>  [
//                [
//                    'content' =>
//                        \yii\bootstrap\Html::button('<i class="fas fa-plus"></i>', [
//                            'class' => 'btn btn-success',
//                            'title' => Yii::t('kvgrid', 'Add Book'),
//                            'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");'
//                        ]) . ' '.
//                        \yii\bootstrap\Html::a('<i class="fas fa-redo"></i>', ['grid-demo'], [
//                            'class' => 'btn btn-outline-secondary',
//                            'title'=>Yii::t('kvgrid', 'Reset Grid'),
//                            'data-pjax' => 0,
//                        ]),
//                    'options' => ['class' => 'btn-group mr-2']
//                ],
//                '{export}',
//                '{toggleData}',
//            ],
//                'toggleDataContainer' => ['class' => 'btn-group mr-2'],
//                // set export properties
//                'export' => [
//                'fontAwesome' => true
//            ],
//                ]);
            ?>

        </div>
        <div role="tabpanel" class="tab-pane" id="prihod-tab">...</div>
        <div role="tabpanel" class="tab-pane" id="prihodadd">
<!--            --><?php
//            echo $this->renderAjax('_prihodupdate', [
////                'searchModel' => $searchModel,
//                'model' => $model,
//            ]);
//            ?>
            ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="settings">...</div>
    </div>

</div>


<?php
//$this->registerJs(
//    "     $('a[data-toggle=\"tab\"]').on('shown.bs.tab', function (e) {
//            console.log( e.target) // newly activated tab
////            e.relatedTarget // previous active tab
////        })
//
//});
//",
//    \yii\web\View::POS_READY,
//    'my-button-handler'
//);
//?>
<!---->

<?php
//$form = ActiveForm::begin();
//echo TabularForm::widget([
//    'dataProvider'=>$dataProvider,
//    'form'=>$form,
//    'attributes'=>$searchModel->formAttribs,
//    'gridSettings'=>[
//        'condensed'=>true,
//        'floatHeader'=>true,
////        'columns' => $columns,
//        'panel'=>[
//            'heading' => '<i class="fas fa-book"></i> Manage Books',
//            'before' => false,
//            'type' => GridView::TYPE_PRIMARY,
//            'after'=> \yii\bootstrap\Html::a('<i class="fas fa-plus"></i> Add New', '#', ['class'=>'btn btn-success']) . ' ' .
//                \yii\bootstrap\Html::a('<i class="fas fa-times"></i> Delete', '#', ['class'=>'btn btn-danger']) . ' ' .
//                \yii\bootstrap\Html::submitButton('<i class="fas fa-save"></i> Save', ['class'=>'btn btn-primary'])
//        ]
//    ]
//]);
//ActiveForm::end();
//?>

