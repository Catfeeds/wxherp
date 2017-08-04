<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use common\messages\Common;
use common\extensions\Captcha;
use common\models\User;
use common\models\NotityTemplate;
use common\forms\RegisterEmail;
use common\forms\RegisterMobile;
use common\forms\FindPassword;
use common\forms\FindPasswordValidate;
use common\forms\UserLogin;

class SiteController extends _FrontendController {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionError() {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception) {
            $this->setLayout();
            return $this->render('error', ['exception' => $exception]);
        }
    }

    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new UserLogin();

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->login()) {
                    return $this->redirect(Url::to(['/user/index']));
                }
            }
        }

        $this->setLayout();

        return $this->render('login', ['model' => $model]);
    }

    public function actionRegisterMobile() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegisterMobile();

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                $model->create_type = User::CREATE_PC;
                $user = $model->register(true);
                if ($user && Yii::$app->user->login($user)) {
                    return $this->redirect(Url::to(['register-success']));
                }
            }
        }

        $this->setLayout();

        return $this->render('register-mobile', ['model' => $model]);
    }

    public function actionRegisterEmail() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegisterEmail();

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                $model->create_type = User::CREATE_PC;
                $user = $model->register();
                if ($user && Yii::$app->user->login($user)) {
                    return $this->redirect(Url::to(['register-success']));
                }
            }
        }

        $this->setLayout();

        return $this->render('register-email', ['model' => $model]);
    }

    public function actionRegisterSuccess() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->setLayout();

        return $this->render('register-success');
    }

    public function actionFindPassword() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new FindPassword();

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    return $this->redirect(Url::to(['find-password-validate', 'username' => $model->username]));
                }
            }
        }

        $this->setLayout();

        return $this->render('find-password', ['model' => $model]);
    }

    public function actionFindPasswordValidate() {
        $model = new FindPasswordValidate();
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    return $this->redirect(Url::to(['find-password-success']));
                }
            }
        }
        $username = Yii::$app->request->get('username');
        if (empty($username)) {
            return $this->goHome();
        }
        $user = User::findByMobile($username);
        $type = 'mobile';
        if (!$user) {
            $user = User::findByEmail($username);
            $type = 'email';
        }
        if ($user) {
            $var['model'] = $model;
            $var['user'] = $user;
            $var['username'] = $username;
            $var['type'] = $type;

            $this->setLayout();

            return $this->render('find-password-validate', $var);
        } else {
            return $this->goHome();
        }
    }

    public function actionFindPasswordSuccess() {
        $this->setLayout();

        return $this->render('find-password-success');
    }

    public function actionSmsCode() {
        if (Yii::$app->request->isAjax) {
            $mobile = Yii::$app->request->post('mobile');
            $captcha = Yii::$app->request->post('captcha');
            $code_type = Yii::$app->request->post('type');
            if (!Captcha::checkCaptcha($captcha)) {
                $this->ajaxError(Yii::t('common', Common::CAPTCHA_CHECK_FAIL));
            }
            $result = NotityTemplate::sendSmsCode($code_type, $mobile);
            if ($result === true) {
                $this->ajaxSuccess();
            } else {
                $this->ajaxError($result);
            }
        }
        $this->ajaxError();
    }

    public function actionEmailCode() {
        if (Yii::$app->request->isAjax) {
            $email = Yii::$app->request->post('email');
            $captcha = Yii::$app->request->post('captcha');
            $code_type = Yii::$app->request->post('type');
            if (Captcha::checkCaptcha($captcha)) {
                $result = NotityTemplate::sendEmailCode($code_type, $email);
                if ($result === true) {
                    $this->ajaxSuccess();
                } else {
                    $this->ajaxError($result);
                }
            } else {
                $this->ajaxError(Yii::t('common', Common::CAPTCHA_CHECK_FAIL));
            }
        }
        $this->ajaxError();
    }

}
