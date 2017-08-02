<?php

namespace backend\modules\user\controllers;

use Yii;
use backend\modules\user\forms\UserOperationLogSearch;
use backend\controllers\_BackendController;

class UserOperationLogController extends _BackendController {

    public function actionIndex() {
        $searchModel = new UserOperationLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

}
