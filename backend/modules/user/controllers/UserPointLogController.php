<?php

namespace backend\modules\user\controllers;

use Yii;
use backend\modules\user\forms\UserPointLogSearch;
use backend\controllers\_BackendController;

class UserPointLogController extends _BackendController {

    public function actionIndex() {
        $searchModel = new UserPointLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

}
