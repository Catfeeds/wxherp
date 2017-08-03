<?php

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\widgets\ActiveForm;

$this->title = '忘记密码';
?>
<div class="container">
    <div class="find-password-form panel panel-default">
        <div class="panel-heading text-center">忘记密码</div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'captcha', ['template' => '{label}<div class="col-sm-3">{input}</div><div class="col-sm-4"><img class="captcha-image" src="' . Url::to(['captcha']) . '" alt="看不清楚请点击换一个试试" title="看不清楚请点击换一个试试"></div><div class="col-sm-3">{error}</div>'])->textInput(['maxlength' => true]) ?>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <?= Html::submitButton('下一步 验证身份', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?= $this->render('../user/_code'); ?>
