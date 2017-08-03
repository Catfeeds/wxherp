<?php

namespace common\widgets\editor;

use Yii;
use yii\base\Widget;
use yii\helpers\Url;
use common\widgets\editor\EditorAsset;
use common\extensions\CheckRule;
use common\models\_CommonModel;

class Editor extends Widget {

    public $id = ''; //控件ID
    public $object_id = 0; //项目对象ID
    public $object_type = 0; //项目对象类型
    public $create_type = _CommonModel::CREATE_ADMIN;
    public $value = ''; //控件默认值
    public $height = '300px'; //editor高度
    public $upload_url = '/uploader/file'; //上传附件路由

    public function run() {
        $this->name = $this->name ? $this->name : _CommonModel::EDITOR_FIELD_NAME;
        if (empty($this->id)) {
            $this->id = $this->name;
        }

        $var['id'] = $this->id;
        $var['name'] = $this->name;
        $var['value'] = $this->value;
        $var['height'] = $this->height;
        $var['upload_url'] = ($this->create_type === _CommonModel::CREATE_ADMIN && CheckRule::checkRole($this->upload_url)) || $this->create_type === _CommonModel::CREATE_PC ? Url::to([$this->upload_url]) : false; //是否需要显示上传按钮
        $var['param'] = [Yii::$app->request->csrfParam => Yii::$app->request->csrfToken, 'object_id' => $this->object_id, 'object_type' => $this->object_type];

        EditorAsset::register($this->view);
        return $this->render('editor', $var);
    }

}
