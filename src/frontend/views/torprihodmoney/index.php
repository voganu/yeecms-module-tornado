<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TorPrihodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tor Prihods';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="clearfix">
    <div class="pull-right">
        <?=Html::a('<i class="glyphicon glyphicon-arrow-left"></i> вернуться', ['default/index'],   [ 'class'=>'btn btn-default'])        ?>
    </div>
    <h4 class="pull-left">Приход деньги за: <?=$currDate?></h4>
</div>
<br>

<div class="tor-prihod-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>$crudId,
            'dataProvider' => $dataProvider,
//            'filterModel' => $searchModel,
            'showPageSummary'=>true,
            'pjax'=>true,
            'pjaxSettings'=>[
                    'cache' => false
            ],
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create', 'currDate'=>$currDate ],
                        ['id' =>'new', 'role'=>'modal-remote','title'=> 'Новый приход','class'=>'btn btn-success'])
//                    .' '.
//                    Html::a('вернуться', ['default/index'],
//                        [ 'class'=>'btn btn-default'])

//                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
//                        ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
//                    '{toggleData}'.
//                    '{export}'
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> Приход',
//                'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                'after'=>BulkButtonWidget::widget([
                        'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; удалить',
                            ["bulk-delete"] ,
                            [
                                "class"=>"btn btn-danger btn-xs",
                                'role'=>'modal-remote-bulk',
                                'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                'data-request-method'=>'post',
                                'data-confirm-title'=>'Вы уверены?',
                                'data-confirm-message'=>'Вы уверены что хотите удалить эти элементы?'
                            ]),
                    ]).
                    '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
<?php if($new):?>
    <?php
$this->registerJs("
    $(function() {
    $('a#new').click();
    });
", \yii\web\View::POS_END);
    ?>
<?php endif;?>
<?php
//$this->registerJs("
//    $.fn.modal.Constructor.prototype.enforceFocus = function() {};
//", \yii\web\View::POS_END);
//?>

