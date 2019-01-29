<?php
use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
$form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);
echo FormGrid::widget([
    'model'=>$model,
    'form'=>$form,
//    'autoGenerateColumns'=>true,
    'rows'=>[
        [
//            'contentBefore'=>'<legend class="text-info"><small>Account Info</small></legend>',
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
                    'widgetClass'=>'\kartik\select2\Select2',
                    'options'=>['data'=>\yii\helpers\ArrayHelper::map(\voganu\tornado\models\Postav::find()->all(), 'id', 'name')],
//                    'hint'=>'Type and select state'
                ],
            ]
        ],
]
]);
ActiveForm::end();
/**
 * Created by PhpStorm.
 * User: ivv
 * Date: 08.01.2019
 * Time: 15:55
 */