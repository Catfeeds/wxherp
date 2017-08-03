<?php

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\widgets\ActiveForm;
use common\extensions\Util;
use common\models\User;

$this->title = '忘记密码';
?>
<div class="container">
    <div class="find-password-form panel panel-default">
        <div class="panel-heading text-center">忘记密码</div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="form-group">
                <label for="select_type" class="col-sm-2 control-label">验证方式</label>
                <div class="col-sm-3">
                    <select id="select_type" class="form-control" onchange="window.location.href = this.options[this.options.selectedIndex].value">
                        <?php if ($user->c_mobile_verify == User::STATUS_YES) { ?>
                            <option value="<?= Url::to(['find-password-validate', 'username' => $user->c_mobile]) ?>"<?= $username == $user->c_mobile ? ' selected="selected"' : '' ?>>已认证手机 <?= Util::hiddenMobile($user->c_mobile) ?></option>
                        <?php } ?>
                        <?php if ($user->c_email_verify == User::STATUS_YES) { ?>
                            <option value="<?= Url::to(['find-password-validate', 'username' => $user->c_email]) ?>"<?= $username == $user->c_email ? ' selected="selected"' : '' ?>>已认证邮箱 <?= Util::hiddenEmail($user->c_email) ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <?= $form->field($model, 'captcha', ['template' => '{label}<div class="col-sm-3">{input}</div><div class="col-sm-4"><img class="captcha-image" src="' . Url::to(['captcha']) . '" alt="看不清楚请点击换一个试试" title="看不清楚请点击换一个试试"></div><div class="col-sm-3">{error}</div>'])->textInput(['maxlength' => true]) ?>
            <?php if ($type == 'mobile') { ?>
                <?= Html::activeHiddenInput($model, 'mobile', array('value' => $user->c_mobile)) ?>
                <?= $form->field($model, 'sms_captcha', ['template' => '{label}<div class="col-sm-3">{input}</div><div class="col-sm-4"><button type="button" class="btn btn-default" id="sms-code-btn" data-url="' . Url::to(['sms-code']) . '" data-form="FindPasswordValidate" data-type="code_find_password">获取短信验证码</button></div><div class="col-sm-3">{error}</div>'])->textInput(['maxlength' => true]) ?>
            <?php } else { ?>
                <?= Html::activeHiddenInput($model, 'email', array('value' => $user->c_email)) ?>
                <?= $form->field($model, 'email_captcha', ['template' => '{label}<div class="col-sm-3">{input}</div><div class="col-sm-4"><button type="button" class="btn btn-default" id="email-code-btn" data-url="' . Url::to(['email-code']) . '" data-form="FindPasswordValidate" data-type="code_find_password">获取邮箱校验码</button></div><div class="col-sm-3">{error}</div>'])->textInput(['maxlength' => true]) ?>
            <?php } ?>
            <?= $form->field($model, 'password', ['template' => '{label}<div class="col-sm-3">{input}</div><div class="col-sm-3">{error}</div>'])->passwordInput(['maxlength' => true]) ?>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <?= Html::submitButton('下一步', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?= $this->render('../user/_code'); ?>
