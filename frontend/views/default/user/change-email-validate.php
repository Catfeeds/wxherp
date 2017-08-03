<?php

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\widgets\ActiveForm;

$this->title = '设置邮箱';
?>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-envelope"></i> 设置邮箱</div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'captcha', ['template' => '{label}<div class="col-sm-3">{input}</div><div class="col-sm-4"><img class="captcha-image" src="' . Url::to(['site/captcha']) . '" alt="看不清楚请点击换一个试试" title="看不清楚请点击换一个试试"></div><div class="col-sm-3">{error}</div>'])->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'email_captcha', ['template' => '{label}<div class="col-sm-3">{input}</div><div class="col-sm-4"><button type="button" class="btn btn-default" id="email-code-btn" data-url="' . Url::to(['site/email-code']) . '" data-form="ChangEmailValidate" data-type="code_change_email">获取邮箱校验码</button></div><div class="col-sm-3">{error}</div>'])->textInput(['maxlength' => true]) ?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?= Html::submitButton('下一步 验证身份', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?= $this->render('_code'); ?>
