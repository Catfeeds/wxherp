<?php

use common\widgets\cropper\Cropper;
use common\models\UserProfile;
?>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-camera-retro"></i> 上传头像</div>
    <div class="panel-body">
        <div class="preview preview-md mb20">
            <img src="<?= UserProfile::getHead() ?>">
        </div>
        <?= Cropper::widget(['value' => UserProfile::getHead()]) ?>
    </div>
</div>