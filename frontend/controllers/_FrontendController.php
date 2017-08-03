<?php

namespace frontend\controllers;

use Yii;
use common\controllers\_CommonController;

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

    protected function commonCreate($model, $data = null) {
        return $this->_commonCreate($model, $data, false);
    }

    protected function commonUpdate($model, $data = null) {
        return $this->_commonUpdate($model, $data, false);
    }

    protected function commonUpdateField($model_name, $update, $where, $is_ajax = false) {
        return $this->_commonUpdateField($model_name, $update, $where, $is_ajax, false);
    }

    protected function commonDelete($model_name, $id = null) {
        return $this->_commonDelete($model_name, $id, false);
    }

}
