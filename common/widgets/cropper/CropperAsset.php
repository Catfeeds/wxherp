<?php

namespace common\widgets\cropper;

use yii\web\AssetBundle;
use yii\web\View;

class CropperAsset extends AssetBundle {

    public $sourcePath = '@common/widgets/cropper/static';
    public $js = ['js/cropper.min.js'];
    public $css = ['css/cropper.min.css', 'css/style.css'];
    public $jsOptions = ['position' => View::POS_BEGIN];

}
