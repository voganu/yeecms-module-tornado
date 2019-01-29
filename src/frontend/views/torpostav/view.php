<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TorPrihod */
?>
<div class="tor-prihod-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'status.name',
            'name',
            'description',
        ],
    ]) ?>

</div>
