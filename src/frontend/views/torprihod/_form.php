<?php
use kartik\form\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;

use yii\helpers\Html;
//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TorPrihod */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$form = ActiveForm::begin([
//    'id' => 'prihod-update_form',
    'type'=>ActiveForm::TYPE_VERTICAL,
//    'action' => ['/tornado/prihod/save', 'id' => $model->id],
//    'enableAjaxValidation' => true,
//    'validationUrl' => ['/tornado/prihod/validate'],
]);
echo FormGrid::widget([
    'model'=>$model,
    'form'=>$form,
//    'autoGenerateColumns'=>false,
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
            ]
        ],
            [
//                'contentBefore'=>'<legend class="text-info"><small>Profile Info</small></legend>',
                'columns'=>3,
                'autoGenerateColumns'=>false, // override columns setting
            'attributes'=>[       // 2 column layout
//                'columns' => 2,
                'postav_id'=>[
                    'type'=>Form::INPUT_WIDGET,
//                    'items'=>\yii\helpers\ArrayHelper::map(\voganu\tornado\models\Postav::find()->asArray()->all(), 'id', 'name'),
//                    'type'=>Form::INPUT_DROPDOWN_LIST,
//                    'items'=>\yii\helpers\ArrayHelper::map(\voganu\tornado\models\Postav::find()->asArray()->all(), 'id', 'name'),
                    'widgetClass'=>'\kartik\select2\Select2',
                    'columnOptions' => ['colspan'=>2],
                    'labelOptions' => ['class' => 'is-required'], // displays the required asterisk
//                    'options' => ['id' => 'prihod-update-postav', 'placeholder'=>'поставщик....'],
                    'options' => [
                        'options' => ['id' => 'prihod-update-postav', 'placeholder'=>'поставщик....'],
                        'data'=>\yii\helpers\ArrayHelper::map(\voganu\tornado\models\Postav::find()->asArray()->all(), 'id', 'name'),
                    ],
                ],
                'procent_id'=>[
                    'labelOptions' => ['class' => 'is-required'], // displays the required asterisk
                    'columnOptions' => ['colspan'=>1],
                    'type'=>Form::INPUT_DROPDOWN_LIST,
                    'items'=>\yii\helpers\ArrayHelper::map(\voganu\tornado\models\Procent::find()->asArray()->all(), 'id', 'name')
                ],
            ],
        ],
        [
//            'contentBefore'=>'<legend class="text-info"><small>Account Info</small></legend>',
            'attributes'=>[       // 2 column layout
                'prihod_summa'=>[
                    'type'=>Form::INPUT_TEXT,
                ],
                'rashod_summa'=>[
                    'type'=>Form::INPUT_TEXT,
                ],
            ],

        ],
        [
            'attributes'=>[       // 2 column layout
                'vozvrat_dolga'=>[
                    'type'=>Form::INPUT_TEXT,
                ],
                'nakl'=>[
                    'type'=>Form::INPUT_TEXT,
                ],
            ],

        ],

    ],

]);
?>
<?php if (!Yii::$app->request->isAjax){ ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
<?php } ?>
<?php
ActiveForm::end();

?>