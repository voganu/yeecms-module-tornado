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
            'prihod_date',
            'nakl',
            'postav.name',
            'procent.name',
            'prihod_summa',
            'rashod_summa',
            'dolg',
            'vozvrat_dolga'
        ],
    ]) ?>

</div>
