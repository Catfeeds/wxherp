<?php

namespace frontend\controllers;

use Yii;
use common\controllers\_CommonController;
use common\models\_CommonModel;

class _FrontendController extends _CommonController {

    public $title;
    public $template;

    public function init() {
        parent::init();
        if (Yii::$app->params['system_site_open'] === '2') {
            self::alert(Yii::$app->params['system_site_close_msg']);
        }
        $this->template = isset(Yii::$app->params['system_template']) && Yii::$app->params['system_template'] ? Yii::$app->params['system_template'] : 'default';
        $this->layout = '@app/views/' . $this->template . '/layouts/nav.php';
        $this->setViewPath('@app/views/' . $this->template . '/' . $this->id);
    }

    public function setLayout($type = self::MAIN_LAYOUT) {
        if (self::MAIN_LAYOUT == $type) {
            $this->layout = '@app/views/' . $this->template . '/layouts/main.php';
        } elseif (self::NAV_LAYOUT == $type) {
            $this->layout = '@app/views/' . $this->template . '/layouts/nav.php';
        } elseif (self::USER_LAYOUT == $type) {
            $this->layout = '@app/views/' . $this->template . '/layouts/user.php';
        }
    }

    protected function frontendCreate($model, $data = null) {
        return $this->commonCreate($model, $data, _CommonModel::CREATE_PC);
    }

    protected function frontendUpdate($model, $data = null) {
        return $this->commonUpdate($model, $data, _CommonModel::CREATE_PC);
    }

    protected function frontendUpdateField($model_name, $update, $where) {
        return $this->commonUpdateField($model_name, $update, $where, _CommonModel::CREATE_PC);
    }

    protected function frontendDelete($model_name, $id = null) {
        return $this->commonDelete($model_name, $id, _CommonModel::CREATE_PC);
    }

}
