<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Html::encode($exception->getMessage());
?>
<div class="container">
    <div class="alert alert-danger" role="alert">
        <h4><?= $exception->statusCode ?> <?= Html::encode($exception->getMessage()) ?></h4>
        <p>
            您可以 <a href="javascript:void(0);" onclick="history.back();">返回上一页</a>
            或者 <a href="<?= Url::to(['site/index']); ?>">返回首页</a>
        </p>
    </div>
</div>