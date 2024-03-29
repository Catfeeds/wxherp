<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use common\models\Article;
use frontend\forms\ArticleSearch;

class ArticleController extends _UserController {

    public function actionIndex() {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    public function actionCreate() {
        $model = new Article();

        if (Yii::$app->request->isPost) {
            if ($this->frontendCreate($model)) {
                return $this->redirect(Url::to(['index']));
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->c_user_id == Yii::$app->user->id) {
            if (Yii::$app->request->isPost) {
                if ($this->frontendUpdate($model)) {
                    return $this->redirect(Url::to(['index']));
                }
            }

            return $this->render('update', ['model' => $model]);
        } else {
            $this->flashError('无权限操作');
            return $this->redirect(Url::to(['index']));
        }
    }

    public function actionDelete($id) {
        if (Yii::$app->request->isPost) {
            if ($this->frontendUpdateField(Article::className(), ['c_is_delete' => Article::DELETE_YES], ['c_id' => $id, 'c_user_id' => Yii::$app->user->id])) {
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
