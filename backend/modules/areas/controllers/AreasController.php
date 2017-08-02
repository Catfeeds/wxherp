<?php

namespace backend\modules\areas\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use common\models\Areas;
use backend\modules\areas\forms\AreasSearch;
use backend\controllers\_BackendController;

class AreasController extends _BackendController {

    public function actionIndex() {
        $searchModel = new AreasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    public function actionCreate() {
        $model = new Areas();
        if (Yii::$app->request->isPost) {
            if ($this->commonCreate($model)) {
                return $this->refresh();
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            if ($this->commonUpdate($model)) {
                return $this->refresh();
            }
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id) {
        if (Yii::$app->request->isPost) {
            if ($this->commonDelete(Areas::className(), $id)) {
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
    }

    public function actionMake() {
        if (Yii::$app->request->isPost) {
            $result = Areas::make();
            if ($result === true) {
                $this->flashSuccess();
            } else {
                $this->flashError($result);
            }
        }

        return $this->redirect(['index']);
    }

    protected function findModel($id) {
        if (($model = Areas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
