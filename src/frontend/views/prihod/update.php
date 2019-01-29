<?php
use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\detail\DetailView;
use lo\widgets\modal\ModalAjax;


//echo DetailView::widget([
//    'model'=>$model,
//    'condensed'=>true,
//    'hover'=>true,
//    'mode'=>DetailView::MODE_EDIT,
//    'panel'=>[
//        'heading'=>'Book # ' . $model->id,
//        'type'=>DetailView::TYPE_PRIMARY,
//    ],
//    'attributes'=>[
//
//        'columns'=>[
////            [
////            'attribute'=>'prihod_date',
////            'format'=>'date',
////            'type'=>DetailView::INPUT_DATE,
////            'widgetOptions' => [
////                'pluginOptions'=>['format'=>'yyyy-mm-dd']
////            ],
////            'valueColOptions'=>['style'=>'width:30%']
////            ],
////            [
//                'attribute'=>'postav_id',
////                'format'=>'text',
//                'type'=>DetailView::INPUT_SELECT2,
////                'options' => [
////                           'options' => ['id' => 'prihod-update-postav'],
////                       'data'=>\yii\helpers\ArrayHelper::map(\voganu\tornado\models\Postav::find()->asArray()->all(), 'id', 'name'),
////                ],
//            'widgetOptions' => [
//                'data'=>\yii\helpers\ArrayHelper::map(\voganu\tornado\models\Postav::find()->asArray()->all(), 'id', 'name'),
//
//            ]
//        ],
//            //            'attribute'=>'prihod_date',
////            'type'=>DetailView::INPUT_WIDGET,
////            'format' => 'date',
////            'widgetOptions' => [
////                'language' => 'ru-RU',
////                'pluginOptions' => [
////                    'format' => 'dd/mm/yyyy',
////                    'autoclose'=>true,
////                    'todayHighlight' => true
////                ]],
//            ],
//    //        'code',
//    //        'name',
//    //        ['attribute'=>'publish_date', 'type'=>DetailView::INPUT_DATE],
////        ]
//
//]);
?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Panel title</h3>
        </div>
        <div class="panel-body">
<?php
\yii\widgets\Pjax::begin([
    'id' => 'torprihod-update-pjax',
    'timeout' => 5000,
]);

$form = ActiveForm::begin([
    'id' => 'prihod-update_form',
    'type'=>ActiveForm::TYPE_VERTICAL,
//    'action' => ['/tornado/prihod/save', 'id' => $model->id],
//    'enableAjaxValidation' => true,
//    'validationUrl' => ['/tornado/prihod/validate'],
]);
echo FormGrid::widget([
    'model'=>$model,
    'form'=>$form,
//    'autoGenerateColumns'=>true,
    'rows'=>[
        [
            'attributes'=>[       // 2 column layout
                'prihod_date'=>[
                        'type'=>Form::INPUT_WIDGET,
                        'widgetClass'=>'\kartik\widgets\DatePicker',
                        'options'=>['language' => 'ru-RU',
                            'pluginOptions' => [
                                'format' => 'dd/mm/yyyy',
                                'autoclose'=>true,
                                'todayHighlight' => true
                            ]],
//                        'hint'=>'Enter birthday (mm/dd/yyyy)'
                ],
                'postav_id'=>[
                    'type'=>Form::INPUT_WIDGET,
//                    'items'=>\yii\helpers\ArrayHelper::map(\voganu\tornado\models\Postav::find()->asArray()->all(), 'id', 'name')
                    'widgetClass'=>'\kartik\select2\Select2',
                    'options' => [
                            'options' => ['id' => 'prihod-update-postav'],
                        'data'=>\yii\helpers\ArrayHelper::map(\voganu\tornado\models\Postav::find()->asArray()->all(), 'id', 'name'),
                    ],
//                'postav_id'=>[
//                    'type'=>Form::INPUT_TEXT,
                ],
                'actions' => [
                    'type'=>Form::INPUT_RAW,
                    'value'=>  \yii\helpers\Html::a('++', ['create'], [
                        'title' => 'asfas',
                        'class' => 'btn',
//                        'data' => [
//                            'key' => $model->id,
//                        'target' => '#detail',
//                        'toggle' => 'modal',
//                        'backdrop' => 'static',
//                        ]
                    ])
                ],
                'procent_id'=>[
                    'type'=>Form::INPUT_DROPDOWN_LIST,
                    'items'=>\yii\helpers\ArrayHelper::map(\voganu\tornado\models\Procent::find()->asArray()->all(), 'id', 'name')
                    ],
//                    'widgetClass'=>'\kartik\select2\Select2',
//                    'options' => [
//                        'options' => ['id' => 'prihod-update-procent'],
//                        'data'=>\yii\helpers\ArrayHelper::map(\voganu\tornado\models\Procent::find()->asArray()->all(), 'id', 'name')],
                ],
//                ],
        ],
        [
//            'contentBefore'=>'<legend class="text-info"><small>Account Info</small></legend>',
            'attributes'=>[       // 2 column layout
//                'postav_id'=>[
//                    'type'=>Form::INPUT_TEXT,
//                ],
                'prihod_summa'=>[
                    'type'=>Form::INPUT_TEXT,
                ],
                'rashod_summa'=>[
                    'type'=>Form::INPUT_TEXT,
                ],
            ],

        ],

        ],

]);
?>
        </div>
    </div>

    <div class="form-group">
        <?= \yii\bootstrap\Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        <?= \yii\bootstrap\Html::resetButton('Отменить', ['class' => 'btn btn-default']) ?>
        <?php echo \yii\bootstrap\Html::button('Back', array(
                'name' => 'btnBack',
                'class' => 'btn btn-default',
//                'style' => 'width:'.$this->width.';',
                'onclick' => "history.go(-1)",
            )
        );?>
    </div>
<?php
ActiveForm::end();
\yii\widgets\Pjax::end();


echo ModalAjax::widget([
    'id' => 'updateCompany',
    'selector' => 'a.btn', // all buttons in grid view with href attribute
    'ajaxSubmit' => true, // Submit the contained form as ajax, true by default

    'options' => ['class' => 'header-primary'],
    'pjaxContainer' => '#torprihod-update-pjax',
//    'events'=>[
//    ModalAjax::EVENT_MODAL_SHOW => new \yii\web\JsExpression("
//            function(event, data, status, xhr, selector) {
//                selector.addClass('warning');
//            }
//       "),
//    ModalAjax::EVENT_MODAL_SUBMIT => new \yii\web\JsExpression("
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

]);
/**
 * Created by PhpStorm.
 * User: ivv
 * Date: 08.01.2019
 * Time: 15:55
 */