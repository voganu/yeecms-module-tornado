<?php
namespace voganu\tornado\frontend\controllers;
use kartik\form\ActiveForm;
use voganu\tornado\models\TorPrihod;
use voganu\tornado\models\TorPrihodSearch;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yeesoft\controllers\admin\BaseController;


class PrihodController extends BaseController
{

    public function actionDetail()
    {
        $request = \Yii::$app->getRequest();
//        if ( $request->isPost && ($id = (isset($_POST['expandRowKey']) ? $_POST['expandRowKey'] : null ))) {
            $queryParams = [];
            $queryParams['TorPrihodSearch'] = ['prihod_date' => $_POST['expandRowKey']];
            $searchModel = new TorPrihodSearch();
            $dataProvider = $searchModel->search($queryParams);
//            $variable= $anydata; //anydata want to send in expanded view
            return $this->renderPartial('prihodtab', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'key' => $_POST['expandRowKey']
            ]);
//            return $this->renderPartial('index',['anydata'=>$anydata,'model'=>$model]);
//        }
//        else
//        {
//            return '<div class="alert alert-danger">No data found</div>';
//
//        }
    }

    protected function setCoookies($val){
        $cookies = \Yii::$app->response->cookies;
// add a new cookie to the response to be sent
        $cookies->add(new \yii\web\Cookie([
            'name' => 'prihodState',
            'value' => $val,
        ]));

    }
    protected function getCoookies(){
        $cookies = \Yii::$app->request->cookies;
        if ($cookies->has('prihodState')){
            return $cookies->getValue('prihodState');
        }
        return [];
    }

    public function actionIndex()
    {
//        $model = new TorPrihod();
        if ($post =\Yii::$app->request->post('prihodDate', null)) {
            $query = []  ;
            $query['TorPrihodSearch'] = ['prihod_date' => $post];
            $this->setCoookies($query);
//            \Yii::$app->response->format = Response::FORMAT_JSON;
//            return ['success' => $model->save()];
        } else {
            $query = \Yii::$app->request->queryParams;
            if (empty($query)){
                $query = $this->getCoookies();

            } else {
                $this->setCoookies($query);
            }
        }
//        $request = \Yii::$app->getRequest();

        $searchModel = new TorPrihodSearch();

        $dataProvider = $searchModel->search($query);
//        if ($request->isPost && $model->load($request->post())) {
//        if ($model->load($request->getQueryParams())) {
//            \Yii::$app->response->format = Response::FORMAT_JSON;
//            return ['success' => $model->save()];
//        }
        return $this->render('prihodtab', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'key' =>isset($query['TorPrihodSearch']) ? $query['TorPrihodSearch']['prihod_date']: ''
        ]);

    }

    public function actionSave($id)
    {
        $model = new TorPrihod();
        $model = $this->findModel($id);
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => $model->save()];
        }
    }
    public function actionValidate()
    {
        $model = new TorPrihod();
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
//        if(\Yii::$app->request->isAjax) {
//            return $this->renderAjax(
//                'update',
//                [
//                    'model' => $model,
//                ]
//            );
//        }
            $post = \Yii::$app->request->post();
//        if(!($post = \Yii::$app->request->post())){
//            \Yii::$app->user->setState('prihodDate', $model->prihod_date);
//        };

        if ($model->load($post) && $model->save()) {
            return $this->redirect(
                ['prihod/index']
//                [
//                    'data-method' => 'POST',
//                    'data-params' => [
//                        'prihodDate' => $model->prihod_date,
//                    ],
//                ]
                );
        }
//
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    protected function findModel($id)
    {
        if (($model = TorPrihod::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCreate()
    {
        $model = new TorPrihod();

        if ($model->load(\Yii::$app->request->post())) {
            if ($model->save()) {
                if (\Yii::$app->request->isAjax) {
                    // JSON response is expected in case of successful save
                    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return ['success' => true];
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        if (\Yii::$app->request->isAjax) {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

}