<?php

namespace backend\modules\upload\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use common\models\Upload;
use backend\modules\Upload\forms\UploadSearch;
use backend\controllers\_BackendController;

class UploadController extends _BackendController {

    public function actionIndex() {
        $searchModel = new UploadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    public function actionDelete($id) {
        if (Yii::$app->request->isPost) {
            $model = $this->findModel($id);
            if ($model) {
                Upload::deleteFile($model->c_path);
                $model->delete();
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
    }

    protected function findModel($id) {
        if (($model = Upload::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
