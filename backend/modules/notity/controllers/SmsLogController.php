<?php

namespace backend\modules\notity\controllers;

use Yii;
use backend\modules\notity\forms\SmsLogSearch;
use backend\controllers\_BackendController;

class SmsLogController extends _BackendController {

    public function actionIndex() {
        $searchModel = new SmsLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

}
