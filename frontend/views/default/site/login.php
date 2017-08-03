<?php

use yii\helpers\Html;
use frontend\widgets\ActiveForm;

$this->title = '用户登录';
?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">用户登录</div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <?= $form->field($model, 'remember_me')->checkbox() ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <?= Html::submitButton('立即登录', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

