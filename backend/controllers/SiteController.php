<?php

namespace backend\controllers;

use Yii;
use common\extensions\Util;
use common\forms\UserLogin;
use common\models\_CommonModel;

class SiteController extends _BackendController {

    public function actionTest() {
        return $this->render('test');
    }

    public function actionError() {
        return $this->render('error');
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new UserLogin();
        $model->create_type = _CommonModel::CREATE_ADMIN;
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $this->layout = 'main-login';
            return $this->render('login', ['model' => $model]);
        }
    }

    public function actionLogout() {
        Yii::$app->session['admin_login_num'] = null;
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionMyPassword() {
        $model = Yii::$app->user->identity;
        $model->setScenario('change-password');
        if ($model->load(Yii::$app->request->post())) {
            if ($model->updateLoginPassword()) {
                $this->flashSuccess();
                return $this->refresh();
            } else {
                $this->flashError('修改密码失败', $model);
            }
        }

        return $this->render('my-password', ['model' => $model]);
    }

    public function actionClearCache() {
        Yii::$app->cache->flush(); //数据缓存文件

        $backend_runtime_dir = Yii::getAlias('@backend/runtime');
        $backend_runtime_array = Util::getDir($backend_runtime_dir);

        foreach ($backend_runtime_array as $dir) {
            Util::deleteDirAndFile($backend_runtime_dir . DIRECTORY_SEPARATOR . $dir);
        }

        $backend_dir = realpath(Yii::getAlias('@backend/web/assets'));
        $backend_array = Util::getDir($backend_dir);
        foreach ($backend_array as $dir) {
            Util::deleteDirAndFile($backend_dir . DIRECTORY_SEPARATOR . $dir);
        }

        $frontend_runtime_dir = Yii::getAlias('@frontend/runtime');
        $frontend_runtime_array = Util::getDir($frontend_runtime_dir);
        foreach ($frontend_runtime_array as $dir) {
            Util::deleteDirAndFile($frontend_runtime_dir . DIRECTORY_SEPARATOR . $dir);
        }

        $frontend_dir = realpath(Yii::getAlias('@frontend/web/assets'));
        $frontend_array = Util::getDir($frontend_dir);
        foreach ($frontend_array as $dir) {
            Util::deleteDirAndFile($frontend_dir . DIRECTORY_SEPARATOR . $dir);
        }
        $this->flashSuccess('清空缓存成功');
        return $this->redirect(Yii::$app->request->referrer);
    }

}
