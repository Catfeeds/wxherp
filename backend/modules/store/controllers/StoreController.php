<?php

namespace backend\modules\store\controllers;

use Yii;
use backend\modules\store\forms\StoreSearch;
use backend\controllers\_BackendController;

class StoreController extends _BackendController {

    public function actionIndex() {
        $searchModel = new StoreSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

}
