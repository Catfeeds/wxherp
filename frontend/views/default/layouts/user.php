<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\widgets\Alert;

common\assets\FrontendAsset::register($this);
common\assets\FrontendAsset::overrideSystemConfirm();
$route = Yii::$app->controller->route;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= $this->title ?> - <?= Yii::$app->params['site_title'] ?></title>
        <link rel="icon" type="image/x-icon" href="favicon.ico">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
        <?php $this->head() ?>
        <!--[if lt IE 9]>
          <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php $this->beginBody() ?>
        <?= $this->render('_header'); ?>
        <div class="container">
            <?= Alert::widget() ?>
            <div class="row">
                <div class="col-sm-2">
                    <div class="list-group">
                        <a href="<?= Url::to(['user/index']) ?>" class="list-group-item<?= $route == 'user/index' ? ' active' : '' ?>"><i class="fa fa-home"></i> 欢迎页</a>
                        <a href="<?= Url::to(['user/profile']) ?>" class="list-group-item<?= $route == 'user/profile' ? ' active' : '' ?>"><i class="fa fa-address-card"></i> 个人资料</a>
                        <a href="<?= Url::to(['user/head']) ?>" class="list-group-item<?= $route == 'user/head' ? ' active' : '' ?>"><i class="fa fa-camera-retro"></i> 上传头像</a>
                        <a href="<?= Url::to(['user/security']) ?>" class="list-group-item<?= in_array($route, ['user/security', 'user/change-mobile', 'user/change-mobile-validate', 'user/change-email', 'user/change-email-validate', 'user/change-password', 'user/change-pay-password', 'user/close-pay-password']) ? ' active' : '' ?>"><i class="fa fa-cubes"></i> 账户安全</a>
                    </div>
                    <div class="list-group">
                        <a href="<?= Url::to(['restaurant/index']) ?>" class="list-group-item<?= in_array($route, ['restaurant/index', 'restaurant/create', 'restaurant/update']) ? ' active' : '' ?>"><i class="fa fa-leaf"></i> 我发布的餐厅</a>
                        <a href="<?= Url::to(['store/index']) ?>" class="list-group-item<?= in_array($route, ['store/index', 'store/create', 'store/update']) ? ' active' : '' ?>"><i class="fa fa-shopping-cart"></i> 我发布的商家</a>
                        <a href="<?= Url::to(['event/index']) ?>" class="list-group-item<?= in_array($route, ['event/index', 'event/create', 'event/update']) ? ' active' : '' ?>"><i class="fa fa-calendar-o"></i> 我发布的活动</a>
                        <a href="<?= Url::to(['toeat/index']) ?>" class="list-group-item<?= in_array($route, ['toeat/index', 'toeat/create', 'toeat/update']) ? ' active' : '' ?>"><i class="fa fa-coffee"></i> 我发布的约吃</a>
                        <a href="<?= Url::to(['article/index']) ?>" class="list-group-item<?= in_array($route, ['article/index', 'article/create', 'article/update']) ? ' active' : '' ?>"><i class="fa fa-list-alt"></i> 我发布的文章</a>
                    </div>
                </div>
                <div class="col-sm-10">
                    <?= $content; ?>
                </div>
            </div>
        </div>
        <?= $this->render('_footer'); ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>