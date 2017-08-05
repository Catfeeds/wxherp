<?php

namespace backend\modules\restaurant\controllers;

use Yii;
use backend\modules\restaurant\forms\RestaurantSearch;
use backend\controllers\_BackendController;

class RestaurantController extends _BackendController {

    public function actionIndex() {
        $searchModel = new RestaurantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

}
