<?php

namespace backend\controllers;

use Yii;
use common\messages\Common;
use common\extensions\Util;
use common\models\Config;

class ConfigController extends _BackendController {

    private $config;

    public function actionIndex() {
        if (Yii::$app->request->isAjax) {
            $resule = Config::create();
            if ($resule === true) {
                if ($this->makeFile()) {
                    $this->ajaxSuccess();
                } else {
                    $this->ajaxError(Yii::t('common', Common::SYSTEM_WRITABLE_FAIL));
                }
            } else {
                $this->ajaxError($resule);
            }
        }

        $var['data'] = Config::getData();
        $path = realpath(Yii::getAlias('@frontend') . DIRECTORY_SEPARATOR . 'views');
        $var['dir_array'] = Util::getDir($path);

        return $this->render('index', $var);
    }

    private function makeFile() {
        $file = realpath(Yii::getAlias('@common')) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
        if (is_file($file) && !is_writable($file)) {
            return false;
        }
        $this->saveKV(Config::getData());

        return file_put_contents($file, '<?php return ' . var_export($this->config, true) . ';');
    }

    private function saveKV($data) {
        foreach ($data as $value) {
            foreach ($value as $k => $v) {
                $this->config[$k] = $v;
            }
        }
    }

}
