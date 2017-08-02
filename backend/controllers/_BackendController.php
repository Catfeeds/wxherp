<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use common\messages\Common;
use common\extensions\Util;
use common\extensions\CheckRule;
use common\controllers\_CommonController;

class _BackendController extends _CommonController {

    /**
     * 权限判断
     * @param type $action
     * @return type
     */
    public function beforeAction($action) {
        if (parent::beforeAction($action)) {
            $route = '/' . Yii::$app->controller->getRoute(); // 加上/以便路由配比
            if (CheckRule::checkRole($route)) {
                return true;
            } else {
                CheckRule::isLogin() ? Util::alert(Yii::t('common', Common::SYSTEM_PERMISSION_DENIED)) : $this->redirect(Url::to(['/site/login']));
            }
        }
        return false;
    }

}
