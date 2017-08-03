<?php

use yii\helpers\Url;

$url = Url::to(['captcha', 'refresh' => time()]);
$js = <<<EOT
        $('.captcha-image').click(function () {
            $(this).attr('src', '$url');
        });
EOT;
common\assets\FrontendAsset::addScript($js);
