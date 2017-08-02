<?php

namespace backend\modules\article\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use common\models\Article;
use backend\modules\article\forms\ArticleSearch;
use backend\controllers\_BackendController;

class ArticleController extends _BackendController {

    public function actionIndex() {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    public function actionDelete($id) {
        if (Yii::$app->request->isPost) {
            if ($this->commonDelete(Article::className(), $id)) {
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
    }

    protected function findModel($id) {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
