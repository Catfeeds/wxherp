<?php

namespace backend\modules\notity\controllers;

use Yii;
use backend\modules\notity\forms\EmailLogSearch;
use backend\controllers\_BackendController;

class EmailLogController extends _BackendController {

    public function actionIndex() {
        $searchModel = new EmailLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

}
