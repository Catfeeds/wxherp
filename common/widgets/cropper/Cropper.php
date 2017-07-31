<?php

namespace common\widgets\cropper;

use Yii;
use yii\base\Widget;
use yii\helpers\Url;
use common\widgets\cropper\CropperAsset;

class Cropper extends Widget {

    public $name = '_widget_cropper';
    public $value = ''; //控件默认值
    public $object_id = 0; //关联ID
    public $upload_url = 'uploader/head'; //上传头像路由

    public function run() {
        $var['name'] = $this->name;
        $var['value'] = $this->value;
        $var['upload_url'] = Url::to([$this->upload_url]);
        $var['param'] = [Yii::$app->request->csrfParam => Yii::$app->request->csrfToken, 'object_id' => $this->object_id]; //POST提交参数
        CropperAsset::register($this->view);
        return $this->render('cropper', $var);
    }

}
