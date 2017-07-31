<?php

use yii\helpers\Html;

common\assets\BackendAsset::register($this);
common\assets\BackendAsset::overrideSystemConfirm();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta name="robots" content="noindex,nofollow">
        <meta name="author" content="19744244@qq.com">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link rel="shortcut icon" href="<?= Yii::$app->params['domian_backend']; ?>/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?= Yii::$app->params['domian_backend']; ?>/favicon.ico" type="image/x-icon">
        <?= Html::csrfMetaTags() ?>
        <title>后台管理系统</title>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <?php $this->beginBody() ?>
        <div class="wrapper">
            <?= $this->render('adminlte_header.php') ?>
            <?= $this->render('adminlte_left.php') ?>
            <?= $this->render('adminlte_content.php', ['content' => $content]) ?>
            <?= $this->render('adminlte_footer.php') ?>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>