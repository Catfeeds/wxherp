<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use common\models\UserProfile;
use common\models\Upload;

class UploaderController extends _UserController {

    public function actionHead() {
        $result = false;
        if (Yii::$app->request->isAjax) {
            $result = UserProfile::base64Upload(Yii::$app->request->post('data'));
        }
        $result ? $this->ajaxJump(Url::to(['/profile/head', 'time' => time()])) : $this->ajaxError();
    }

    public function actionPicture() {
        if (Yii::$app->params['upload_picture_status'] === '1') {
            $this->pictureUpload(Upload::CREATE_PC);
        } else {
            $this->jsonFormat('图片上传功能已关闭');
        }
    }

    public function actionFile() {
        if (Yii::$app->params['upload_file_status'] === '1') {
            $this->fileUpload(Upload::CREATE_PC);
        } else {
            $this->jsonFormat('附件上传功能已关闭');
        }
    }

    public function actionDelete() {
        $path = Yii::$app->request->post('path');
        $result = Upload::deleteFile($path, true); //TODO 需要加入日志操作
        $result ? $this->ajaxSuccess() : $this->ajaxError();
    }

}
