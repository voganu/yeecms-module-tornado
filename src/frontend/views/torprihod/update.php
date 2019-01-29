<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TorPrihod */
?>
<div class="tor-prihod-update">

    <?= $this->render('_form', [
        'model' => $model,

    ]) ?>

</div>
<?php
//$this->registerJs("
//    $.fn.modal.Constructor.prototype.enforceFocus = function() {};
//", \yii\web\View::POS_END);
//?>
