<?php

use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

$home = ['label' => '<i class="fa fa-home"></i> 首页', 'url' => Yii::$app->homeUrl, 'encode' => false];
$links = isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [];
$links[] = $this->title;
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1><?= $this->title ?></h1>
        <?= Breadcrumbs::widget(['homeLink' => $home, 'links' => $links]) ?>
    </section>
    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>