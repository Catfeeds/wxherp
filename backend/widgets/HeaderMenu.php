<?php

namespace backend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Url;
use common\extensions\CheckRule;
use common\models\SystemRoute;

class HeaderMenu extends Widget {

    public function run() {
        $route = Yii::$app->controller->getRoute();
        $menu = SystemRoute::getTreeCache();
        $html = '';
        foreach ($menu as $v) {
            if ($v['c_parent_id'] == 0 && $v['c_status'] == 1) {
                $selectstr = isset($v['sub']) && CheckRule::checkSubUrl($route, $v['sub']) ? ' class="active"' : '';
                $icon = $v['c_icon'] ? : 'th-list';
                $html .= '<li' . $selectstr . '><a href="' . Url::to([$v['c_route']]) . '">' . '<i class="fa fa-' . $icon . '"></i> ' . $v['c_title'] . '</a></li>';
            }
        }
        return $html;
    }

}
