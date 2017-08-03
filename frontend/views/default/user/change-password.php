<?php

use yii\helpers\Html;
use frontend\widgets\ActiveForm;

$this->title = '设置登录密码';
?>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-lock"></i> 设置登录密码</div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?= Yii::$app->user->identity->c_user_name ?></p>
            </div>
        </div>
        <?php if (Yii::$app->user->identity->c_login_password) { ?>
            <?= $form->field($model, 'old_password')->passwordInput(['maxlength' => true]) ?>
        <?php } ?>
        <?= $form->field($model, 'new_password')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'confirm_password')->passwordInput(['maxlength' => true]) ?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?= Html::submitButton('设置登录密码', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>