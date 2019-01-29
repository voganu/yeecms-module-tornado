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
//            'contentBefore'=>'<legend class="text-info"><small>Account Info</small></legend>',
            'attributes'=>[       // 2 column layout
                'kassa'=>[
                    'type'=>Form::INPUT_TEXT,
                ],
                'terminal'=>[
                    'type'=>Form::INPUT_TEXT,
                ],
            ],

        ],

    ],

]);
?>
<?php if (!Yii::$app->request->isAjax){ ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
<?php } ?>
<?php
ActiveForm::end();

?>