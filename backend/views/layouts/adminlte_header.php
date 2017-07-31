<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<header class="main-header">
    <?= Html::a('<span class="logo-mini">ERP</span><span class="logo-lg">ERP管理中心</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"><span class="sr-only">Toggle navigation</span></a>
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <?= backend\widgets\HeaderMenu::widget() ?>
                </ul>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (isset(Yii::$app->params['domian_frontend']) && Yii::$app->params['domian_frontend']) { ?>
                            <li><a href="<?= Yii::$app->params['domian_frontend'] ?>" target="_blank"><i class="fa fa-home"></i> 返回首页</a></li>
                        <?php } ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <?= isset(Yii::$app->user->identity->c_user_name) ? Yii::$app->user->identity->c_user_name : '游客'; ?> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?= Url::to(['site/my-profile']) ?>" data-method="post"><i class="fa fa-user"></i> 个人资料</a></li>
                                <li><a href="<?= Url::to(['site/my-password']) ?>" data-method="post"><i class="fa fa-lock"></i> 修改密码</a></li>
                                <li><a href="<?= Url::to(['site/clear-cache']); ?>"><i class="fa fa-trash"></i> 清空缓存</a></li>
                                <li class="divider"></li>
                                <li><a href="<?= Url::to(['site/logout']) ?>" data-method="post"><i class="fa fa-power-off"></i> 安全退出</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

