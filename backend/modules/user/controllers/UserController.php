<?php

namespace backend\modules\user\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use common\models\User;
use common\models\UserAcount;
use backend\modules\user\forms\UserAcountForm;
use backend\modules\user\forms\UserSearch;
use backend\controllers\_BackendController;

class UserController extends _BackendController {

    public function actionIndex() {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    public function actionCreate() {
        $model = new User();
        $model->setScenario('system_create');
        if (Yii::$app->request->isPost) {
            if ($this->commonCreate($model)) {
                return $this->refresh();
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->setScenario('system_update');
        if (Yii::$app->request->isPost) {
            if ($this->commonUpdate($model)) {
                return $this->refresh();
            }
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionAmount($id) {
        $model = $this->findUserAcountModel($id);
        $user_acount_model = new UserAcountForm();
        if ($user_acount_model->load(Yii::$app->request->post())) {
            $result = $user_acount_model->amount();
            if ($result === true) {
                $this->flashSuccess();
                return $this->refresh();
            } else {
                $this->flashError(null, $result);
            }
        }
        return $this->render('amount', ['model' => $model, 'acount' => $user_acount_model]);
    }

    public function actionUpdatePassword($id) {
        $model = $this->findModel($id);
        $model->setScenario('setting-password');
        if ($model->load(Yii::$app->request->post())) {
            if ($model->updateLoginPassword()) {
                $this->flashSuccess();
                return $this->refresh();
            } else {
                $this->flashError($model);
            }
        }

        return $this->render('update-password', ['model' => $model]);
    }

    public function actionDelete($id) {
        if (Yii::$app->request->isPost) {
            if ($this->commonUpdateField(User::className(), ['c_status' => User::STATUS_NO], ['c_id' => $id])) {
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
    }

    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findUserAcountModel($id) {
        if (($model = UserAcount::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
