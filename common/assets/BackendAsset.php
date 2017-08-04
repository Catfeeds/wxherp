<?php

namespace common\assets;

use Yii;
use yii\web\AssetBundle;
use yii\web\View;

class BackendAsset extends AssetBundle {

    public $jsOptions = ['position' => View::POS_HEAD];
    public $sourcePath = '@common/static';
    public $css = [
        'font-awesome/css/font-awesome.min.css',
        'backend/css/adminlte.min.css',
        'backend/css/skins/skin-blue.min.css',
        'backend/css/style.css',
        'datetimepicker/datetimepicker.min.css',
        'chosen/chosen.min.css',
    ];
    public $js = [
        'backend/js/adminlte.min.js',
        'layer/layer.js',
        'datetimepicker/datetimepicker.min.js',
        'chosen/chosen.jquery.min.js',
        'linkagesel/linkagesel.min.js',
        'linkagesel/district-level1.js',
        'linkagesel/district-all.js',
        'validator/jquery.validator.min.js?local=zh-CN',
        'js/jquery.birthday.js',
        'js/common.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public static function overrideSystemConfirm() {
        Yii::$app->view->registerJs('
                yii.confirm = function(message, ok, cancel) {
                    layer.msg(message, {
                        time: 0,
                        btn: ["确定", "取消"],
                        btnAlign: "c",
                        yes: function (index) {
                            layer.msg("正在操作...", {icon: 16, shade: 0.01, time: 0});
                            ok();
                            layer.close(index);
                            return false;
                        },
                        btn2: function () {}
                    });
                    return false;
                }
        ');
    }

    public static function addScript($js) {
        Yii::$app->view->registerJs($js);
    }

    public static function registerJsFile($jsfile) {
        Yii::$app->view->registerJsFile($jsfile);
    }

}
