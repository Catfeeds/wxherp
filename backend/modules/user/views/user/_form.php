<?php

use yii\helpers\Html;
use common\models\User;
use common\models\UserGroup;
use common\models\SystemGroup;
use backend\widgets\ActiveForm;

if ($model->isNewRecord) {
    $model->c_status = 1;
    $model->c_mobile_verify = $model->c_email_verify = User::STATUS_NO;
}
?>
<div class="box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?php
        if ($model->isNewRecord) {
            ?>
            <?= $form->field($model, 'c_user_name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'new_password')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'new_password_confirm')->textInput(['maxlength' => true]) ?>
        <?php } else { ?>
            <div class="form-group">
                <label class="col-lg-2 control-label">用户名</label>
                <div class="col-lg-7">
                    <p class="form-control-static"><?= $model->c_user_name ?></p>
                </div>
            </div>
        <?php } ?>
        <?= $form->field($model, 'c_user_group_id')->dropDownList(UserGroup::getKeyValueCache(), ['prompt' => '选择用户组']) ?>
        <?= $form->field($model, 'c_system_group_id')->dropDownList(SystemGroup::getKeyValueCache(), ['prompt' => '选择管理组']) ?>
        <?= $form->field($model, 'c_mobile')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_mobile_verify')->radioList(User::getStatusVerifyText()) ?>
        <?= $form->field($model, 'c_email')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_email_verify')->radioList(User::getStatusVerifyText()) ?>
        <?= $form->field($model, 'c_status')->radioList(User::getStatusText()) ?>
    </div>
    <div class="modal-footer">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '编辑', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>