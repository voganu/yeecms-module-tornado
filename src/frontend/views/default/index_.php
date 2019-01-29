<?php
use yii\widgets\LinkPager;
use luya\admin\filters\MediumCrop;
use kartik\grid\GridView;
use kartik\form\ActiveForm;
use kartik\builder\TabularForm;
/* @var $this \luya\web\View */
/* @var $provider \yii\data\ActiveDataProvider */
?>
<?php
$columns = [
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
        'attribute' => 'procent',
        'value' => 'procent.name'
    ],
    [
        'attribute' => 'postav_id',
        'value' => 'postav.name',
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
<?php
$form = ActiveForm::begin();
echo TabularForm::widget([
    'dataProvider'=>$dataProvider,
    'form'=>$form,
    'attributes'=>$searchModel->formAttribs,
    'gridSettings'=>[
        'condensed'=>true,
        'floatHeader'=>true,
//        'columns' => $columns,
        'panel'=>[
            'heading' => '<i class="fas fa-book"></i> Manage Books',
            'before' => false,
            'type' => GridView::TYPE_PRIMARY,
            'after'=> \yii\bootstrap\Html::a('<i class="fas fa-plus"></i> Add New', '#', ['class'=>'btn btn-success']) . ' ' .
                \yii\bootstrap\Html::a('<i class="fas fa-times"></i> Delete', '#', ['class'=>'btn btn-danger']) . ' ' .
                \yii\bootstrap\Html::submitButton('<i class="fas fa-save"></i> Save', ['class'=>'btn btn-primary'])
        ]
    ]
]);
ActiveForm::end();
?>
?>
<?php
//    echo GridView::widget([
//    'dataProvider'=> $dataProvider,
//    'filterModel' => $searchModel,
//    'pjax'=>true,
//        'showPageSummary' => true,
////    'columns' => $gridColumns,
//    'responsive'=>true,
//    'hover'=>true,
//        'bordered' =>false,
//        'columns' => $columns,
//        'panel' => [
//            'type' => GridView::TYPE_PRIMARY,
////            'heading' => $heading,
//        ],
//    'toolbar' =>  [
//    [
//        'content' =>
//            \yii\bootstrap\Html::button('<i class="fas fa-plus"></i>', [
//                'class' => 'btn btn-success',
//                'title' => Yii::t('kvgrid', 'Add Book'),
//                'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");'
//            ]) . ' '.
//            \yii\bootstrap\Html::a('<i class="fas fa-redo"></i>', ['grid-demo'], [
//                'class' => 'btn btn-outline-secondary',
//                'title'=>Yii::t('kvgrid', 'Reset Grid'),
//                'data-pjax' => 0,
//            ]),
//        'options' => ['class' => 'btn-group mr-2']
//    ],
//    '{export}',
//    '{toggleData}',
//],
//    'toggleDataContainer' => ['class' => 'btn-group mr-2'],
//    // set export properties
//    'export' => [
//    'fontAwesome' => true
//],
//    ]);
?>
