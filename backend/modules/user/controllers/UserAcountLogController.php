<?php

namespace backend\modules\user\controllers;

use Yii;
use backend\forms\UserAcountLogSearch;
use backend\controllers\_BackendController;

class UserAcountLogController extends _BackendController {

    public function actionIndex() {
        $searchModel = new UserAcountLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

}
