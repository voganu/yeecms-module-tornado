<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TorPrihod */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tor-prihod-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'prihod_date')->textInput() ?>

    <?= $form->field($model, 'prihod_summa')->textInput() ?>

    <?= $form->field($model, 'procent_id')->textInput() ?>

    <?= $form->field($model, 'nakl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'postav_id')->textInput() ?>


    <?php if (!Yii::$app->request->isAjax){ ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
