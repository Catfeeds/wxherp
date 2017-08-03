<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use common\forms\ChangEmailValidate;
use common\forms\ChangMobileValidate;

class UserController extends _UserController {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionProfile() {
        $model = Yii::$app->user->identity->userProfile;
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate() && $model->save()) {
                    $this->flashSuccess();
                    return $this->refresh();
                } else {
                    $this->flashError($model);
                }
            }
        }

        return $this->render('profile', ['model' => $model]);
    }

    public function actionSecurity() {
        return $this->render('security');
    }

    public function actionHead() {
        return $this->render('head');
    }

    /**
     * 更改登录密码
     * @return type
     */
    public function actionChangePassword() {
        $scenario = Yii::$app->user->identity->c_login_password ? 'user-change-password' : 'user-setting-password'; // user-setting-password 用户密码若为空 不验证原密码
        $model = Yii::$app->user->identity;
        $model->setScenario($scenario);

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->updateLoginPassword()) {
                    $this->flashSuccess();
                    return $this->redirect(Url::to(['security']));
                } else {
                    $this->flashError($model);
                }
            }
        }

        return $this->render('change-password', ['model' => $model]);
    }

    /**
     * 更换邮箱
     * @return type
     */
    public function actionChangeEmail() {
        $model = Yii::$app->user->identity;
        $model->setScenario('user-validate-password');
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    Yii::$app->session['change-email'] = true;
                    return $this->redirect(Url::to(['change-email-validate']));
                } else {
                    $this->flashError($model);
                }
            }
        }

        return $this->render('change-email', ['model' => $model]);
    }

    /**
     * 更换邮箱时验证
     * @return type
     */
    public function actionChangeEmailValidate() {
        if (Yii::$app->session['change-email']) {
            $model = new ChangEmailValidate();
            if (Yii::$app->request->isPost) {
                if ($model->load(Yii::$app->request->post())) {
                    if ($model->changeEmail()) {
                        $this->flashSuccess();
                        Yii::$app->session['change-email'] = null;
                        return $this->redirect(Url::to(['security']));
                    } else {
                        $this->flashError($model);
                    }
                }
            }

            return $this->render('change-email-validate', ['model' => $model]);
        } else {
            return $this->redirect(Url::to(['security']));
        }
    }

    /**
     * 更换手机
     * @return type
     */
    public function actionChangeMobile() {
        $model = Yii::$app->user->identity;
        $model->setScenario('user-validate-password');
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    Yii::$app->session['change-mobile'] = true;
                    return $this->redirect(Url::to(['change-mobile-validate']));
                } else {
                    $this->flashError($model);
                }
            }
        }

        return $this->render('change-mobile', ['model' => $model]);
    }

    /**
     * 更换手机时验证
     * @return type
     */
    public function actionChangeMobileValidate() {
        if (Yii::$app->session['change-mobile']) {
            $model = new ChangMobileValidate();
            if (Yii::$app->request->isPost) {
                if ($model->load(Yii::$app->request->post())) {
                    if ($model->changeMobile()) {
                        $this->flashSuccess();
                        Yii::$app->session['change-mobile'] = null;
                        return $this->redirect(Url::to(['security']));
                    } else {
                        $this->flashError($model);
                    }
                }
            }

            return $this->render('change-mobile-validate', ['model' => $model]);
        } else {
            return $this->redirect(Url::to(['security']));
        }
    }

    /**
     * 更改支付密码
     * @return type
     */
    public function actionChangePayPassword() {
        if (empty(Yii::$app->user->identity->c_login_password)) {
            return $this->redirect(Url::to(['security']));
        }
        $scenario = Yii::$app->user->identity->c_pay_password ? 'user-change-pay-password' : 'user-setting-pay-password'; // user-setting-pay-password 用户支付密码若为空 不验证原支付密码 但要验证原登录密码
        $model = Yii::$app->user->identity;
        $model->setScenario($scenario);

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->updatePayPassword()) {
                    $this->flashSuccess();
                    return $this->redirect(Url::to(['security']));
                } else {
                    $this->flashError($model);
                }
            }
        }

        return $this->render('change-pay-password', ['model' => $model]);
    }

    /**
     * 关闭支付密码
     * @return type
     */
    public function actionClosePayPassword() {
        if (empty(Yii::$app->user->identity->c_pay_password) || empty(Yii::$app->user->identity->c_login_password)) {
            return $this->redirect(Url::to(['security']));
        }

        $model = Yii::$app->user->identity;
        $model->setScenario('user-validate-password');

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->closePayPassword()) {
                    $this->flashSuccess();
                    return $this->redirect(Url::to(['security']));
                } else {
                    $this->flashError($model);
                }
            }
        }

        return $this->render('close-pay-password', ['model' => $model]);
    }

}
