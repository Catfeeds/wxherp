<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use common\models\Toeat;

class ToeatController extends _UserController {

    public function actionIndex() {
        $dataProvider = new ActiveDataProvider(['query' => Toeat::find()->with('')]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionCreate() {
        $model = new Toeat();

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
            if ($this->frontendUpdateField(Toeat::className(), ['c_is_delete' => Toeat::DELETE_YES], ['c_id' => $id, 'c_user_id' => Yii::$app->user->id])) {
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
    }

    protected function findModel($id) {
        if (($model = Toeat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
