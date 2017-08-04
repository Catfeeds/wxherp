<?php

namespace backend\modules\event\controllers;

use Yii;
use common\models\EventUser;
use backend\modules\event\forms\EventUserSearch;
use backend\controllers\_BackendController;

class UserController extends _BackendController {

    public function actionIndex() {
        $searchModel = new EventUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    public function actionDelete($id) {
        if (Yii::$app->request->isPost) {
            if (Yii::$app->request->isPost) {
                if ($this->commonUpdateField(EventUser::className(), ['c_status' => EventUser::STATUS_NO], ['c_id' => $id])) {
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
        }
    }

}
