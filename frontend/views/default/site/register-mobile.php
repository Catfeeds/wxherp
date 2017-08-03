<?php

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\widgets\ActiveForm;

$this->title = '手机注册';
?>
<div class="container">
    <div class="register-form panel panel-default">
        <ul class="nav nav-tabs">
            <li role="presentation"><a href="<?= Url::to(['register-email']); ?>">邮箱注册</a></li>
            <li role="presentation" class="active"><a href="<?= Url::to(['register-mobile']); ?>">手机注册</a></li>
        </ul>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'captcha', ['template' => '{label}<div class="col-sm-3">{input}</div><div class="col-sm-4"><img class="captcha-image" src="' . Url::to(['captcha']) . '" alt="看不清楚请点击换一个试试" title="看不清楚请点击换一个试试"></div><div class="col-sm-3">{error}</div>'])->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'sms_captcha', ['template' => '{label}<div class="col-sm-3">{input}</div><div class="col-sm-4"><button type="button" class="btn btn-default" id="sms-code-btn" data-url="' . Url::to(['sms-code']) . '" data-form="RegisterMobile" data-type="code_register">获取短信验证码</button></div><div class="col-sm-3">{error}</div>'])->textInput(['maxlength' => true]) ?>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <?= Html::submitButton('注册', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?= $this->render('../user/_code'); ?>
