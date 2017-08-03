<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use api\controllers\_ApiController;
use common\forms\LoginForm;
use common\forms\RegisterMobileForm;
use common\forms\ForgetPasswordMobileForm;
use common\models\User;
use common\models\NotityTemplate;
use common\models\Upload;
use common\models\Areas;

class UserController extends _ApiController {

    public $modelClass = 'common\models\User';

    public function actions() {
        $actions = parent::actions();
        unset($actions['index'], $actions['view'], $actions['create'], $actions['update'], $actions['delete'], $actions['options']);

        return $actions;
    }

    public function actionLogin() {
        $model = new LoginForm;
        $model->setAttributes(Yii::$app->request->post());
        $model->create_type = User::CREATE_API;
        $result = $model->apiLogin();
        //sleep(5);
        if ($result === false) {
            $this->errorModelJson($model);
        } else {
            $this->successJson($result);
        }
    }

//    public function actionRegister() {
//        $model = new RegisterMobileForm();
//        $model->setAttributes(Yii::$app->request->post());
//        $model->create_type = User::CREATE_H5;
//        $result = $model->register();
//        if ($result === false) {
//            $this->errorModelJson($model);
//        } else {
//            $this->successJson($result);
//        }
//    }
    //test 专用
    public function actionRegister() {
        if (Yii::$app->request->post('sms_captcha') == '0000') {
            $user = User::findOne(['c_mobile' => '18016011673']);
            $area = Areas::getAreaTitle([$user->userProfile->c_province_id, $user->userProfile->c_city_id, $user->userProfile->c_area_id]);
            if ($user) {
                $result = [
                    'token' => $user->c_access_token,
                    'mobile' => $user->c_mobile,
                    'username' => $user->c_user_name,
                    // 'userhead' => $user->userProfile->c_head ? Upload::getUploadUrl() . $user->userProfile->c_head : '',
                    'userpoint' => $user->userAcount->c_point,
                    'userregister' => date('Y-m-d', $user->c_reg_date),
                    'userbirthday' => $user->userProfile->c_birthday ? date('Y-m-d', $user->userProfile->c_birthday) : '',
                    'userarea_id' => $user->userProfile->c_province_id . ',' . $user->userProfile->c_city_id . ',' . $user->userProfile->c_area_id,
                    'userarea' => implode(' ', $area),
                    'usersign' => $user->userProfile->c_sign
                ];
                $this->successJson($result);
            } else {
                $this->errorJson('请后台添加用户18016011673');
            }
        } else {
            $this->errorJson('请后台添加用户18016011673');
        }
    }

    public function actionForgetPassword() {
        $model = new ForgetPasswordMobileForm();
        $model->setAttributes(Yii::$app->request->post());
        $result = $model->setPassword();
        if ($result) {
            $this->successJson();
        } else {
            $this->errorModelJson($model);
        }
    }

    //获取验证码
    public function actionSmsCaptcha() {
        $mobile = Yii::$app->request->post('mobile');
        $type = Yii::$app->request->post('type');
        $result = NotityTemplate::sendSmsCode($type, $mobile);
        if ($result === true) {
            $this->successJson();
        } else {
            $this->errorJson($result);
        }
    }

    //上传图片
    public function actionUploadHead() {
        $base64 = Yii::$app->request->post('head');
        Yii::info($base64);
        if ($base64) {
            $head = $this->upload($base64);
            if ($head) {
                //更新用户头像
                Yii::$app->user->identity->userProfile->c_head = $head;
                Yii::$app->user->identity->userProfile->save();
                $this->successJson();
            } else {
                $this->errorJson();
            }
        }
    }

    //更新用户资料
    public function actionUpdateProfile() {
        if (Yii::$app->request->post('birthday')) {
            Yii::$app->user->identity->userProfile->c_birthday = strtotime(Yii::$app->request->post('birthday'));
        }
        Yii::$app->user->identity->userProfile->c_sign = Yii::$app->request->post('sign');
        $area = explode(',', Yii::$app->request->post('area_id'));
        Yii::$app->user->identity->userProfile->c_province_id = (int) $area[0];
        if (isset($area[1])) {
            Yii::$app->user->identity->userProfile->c_city_id = (int) $area[1];
        } else {
            Yii::$app->user->identity->userProfile->c_city_id = 0;
        }
        if (isset($area[2])) {
            Yii::$app->user->identity->userProfile->c_area_id = (int) $area[2];
        } else {
            Yii::$app->user->identity->userProfile->c_area_id = 0;
        }
        if (Yii::$app->user->identity->userProfile->save()) {
            $area = Areas::getAreaTitle([Yii::$app->user->identity->userProfile->c_province_id, Yii::$app->user->identity->userProfile->c_city_id, Yii::$app->user->identity->userProfile->c_area_id]);
            $result = [
                'userbirthday' => Yii::$app->user->identity->userProfile->c_birthday ? date('Y-m-d', Yii::$app->user->identity->userProfile->c_birthday) : '',
                'userarea_id' => Yii::$app->user->identity->userProfile->c_province_id . ',' . Yii::$app->user->identity->userProfile->c_city_id . ',' . Yii::$app->user->identity->userProfile->c_area_id,
                'userarea' => implode(' ', $area),
                'usersign' => Yii::$app->user->identity->userProfile->c_sign
            ];
            $this->successJson($result);
        } else {
            $this->errorJson();
        }
    }

}
