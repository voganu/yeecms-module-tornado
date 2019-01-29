<?php

namespace voganu\tornado\frontend\controllers;

use DeepCopy\Exception\PropertyException;
use voganu\tornado\models\Prihod;
use voganu\tornado\models\Rashod;
use voganu\tornado\models\TorPrihodSearch;
use voganu\tornado\models\TorRashodSearch;
use Yii;
use voganu\tornado\models\Postav;
//use luya\news\models\Cat;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yeesoft\controllers\admin\BaseController;

/**
 * News Module Default Controller contains actions to display and render views with predefined data.
 *
 * @author Basil Suter <basil@nadar.io>
 */
class RashodController extends BaseController
{
    /**
     * Get Article overview.
     *
     * The index action will return an active data provider object inside the $provider variable:
     *
     * ```php
     * foreach ($provider->models as $item) {
     *     var_dump($item);
     * }
     * ```
     *
     * @return string
     */
    public function actionDetail()
    {
//        $provider = new ActiveDataProvider([
//            'query' => Prihod::find(),//->andWhere(['is_deleted' => false]),
////            'sort' => [
////                'defaultOrder' => $this->module->articleDefaultOrder,
////            ],
//            'pagination' => [
//                'route' => $this->module->id,
//                'params' => ['page' => Yii::$app->request->get('page')],
////                'defaultPageSize' => $this->module->articleDefaultPageSize,
//            ],
//        ]);
        $param = [];
        if (isset($_POST['expandRowKey'])) {
            $param[TorRashodSearch::class] = ['prihod_id' => $_POST['expandRowKey']];
        }
        $searchModel = new TorRashodSearch();
        $dataProvider = $searchModel->search($param);

        return $this->renderPartial('detail', [
//            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
//        return $this->render('index', [
//            'model' => Prihod::class,
//            'provider' => TorPrihodSearch::se,
//        ]);
    }
//    public function actionDetail() {
//        if (isset($_POST['expandRowKey'])) {
//            $model = Rashod::findOne($_POST['expandRowKey']);
//            return $this->renderPartial('_book-details', ['model'=>$model]);
//        } else {
//            return '<div class="alert alert-danger">No data found</div>';
//        }
//    }
}
