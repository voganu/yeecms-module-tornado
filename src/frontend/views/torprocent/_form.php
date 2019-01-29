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
//                'contentBefore'=>'<legend class="text-info"><small>Profile Info</small></legend>',
            'attributes'=>[       // 2 column layout
                'status_id'=>[
                    'items'=>\yii\helpers\ArrayHelper::map(\voganu\tornado\models\TorStatus::find()->asArray()->all(), 'id', 'name'),
                    'type'=>Form::INPUT_DROPDOWN_LIST,
                ],
            ],
        ],
        [
            'attributes'=>[       // 2 column layout
//                'columns' => 2,
                'name' => [
                    'type'=>Form::INPUT_TEXT
                ]

            ],
        ],
        [
            'attributes'=>[       // 2 column layout
//                'columns' => 2,
                'description' => [
                    'type'=>Form::INPUT_TEXTAREA
                ]

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