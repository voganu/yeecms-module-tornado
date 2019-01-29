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
    <h4 class="pull-left">Приход товара по поставщикам </h4>
</div>
<br>


<div class="tor-prihod-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>$crudId,
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'hover' => true,
            'showPageSummary'=>true,
            'pageSummaryRowOptions' => [
                    'class' => 'kv-page-summary warning text-right'
            ],
            'pjax'=>true,
            'pjaxSettings'=>[
                    'cache' => false
            ],
            'columns' => require(__DIR__.'/_columnsgroup.php'),
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> Приход',
//                'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
            ]
        ])?>
    </div>
</div>

