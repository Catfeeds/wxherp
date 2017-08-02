<?php

namespace common\widgets\uploader;

use Yii;
use yii\base\Widget;
use yii\helpers\Url;
use common\extensions\CheckRule;
use common\models\_CommonModel;

class Uploader extends Widget {

    public $object_id = 0; //项目对象ID
    public $object_type = 0; //项目对象类型
    public $create_type = 1; //用户类型 1后台 2前台 前台需要再小部件写入 user_type=2
    public $is_file = false; //false上传图片 true上传文件
    public $name = '';
    public $value = ''; //控件默认值

    public function run() {
        $upload_url = $this->is_file ? '/uploader/file' : '/uploader/picture'; //上传附件路由
        $delete_url = '/uploader/delete'; //删除附件路由
        //多文件上传未指定控件名会指定默认名
        if ($this->object_type && empty($this->name)) {
            $this->name = _CommonModel::FILE_MORE_FILED_NAME;
        }
        $var['name'] = $this->name ? $this->name : ( $this->is_file ? _CommonModel::FILE_FIELD_NAME : _CommonModel::PICTURE_FIELD_NAME);
        $var['value'] = $this->value;
        $var['upload_url'] = ($this->create_type === _CommonModel::CREATE_ADMIN && CheckRule::checkRole($upload_url)) || $this->create_type === _CommonModel::CREATE_PC ? Url::to([$upload_url]) : false; //是否需要显示上传按钮
        $var['delete_url'] = ($this->create_type === _CommonModel::CREATE_ADMIN && CheckRule::checkRole($delete_url)) || $this->create_type === _CommonModel::CREATE_PC ? Url::to([$delete_url]) : false; //是否需要显示删除按钮
        $var['object_id'] = $this->object_id;
        $var['object_type'] = $this->object_type;
        $var['is_file'] = $this->is_file;
        $var['extensions'] = $this->is_file ? '*' : implode(',', Yii::$app->params['image_extensions']);
        $var['more'] = (bool) $this->object_type;
        $template = $this->object_type ? 'multiple' : 'single';
        return $this->render($template, $var);
    }

}
