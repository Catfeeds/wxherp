<?php

use yii\helpers\Html;
use common\models\AdPosition;
use backend\widgets\ActiveForm;

if ($model->isNewRecord) {
    $model->c_count = $model->c_is_count = $model->c_status = 1;
    $model->c_width = $model->c_height = $model->c_sort = 0;
}
?>
<div class="box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?= $form->field($model, 'c_title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_count')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_width')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_height')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_note')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_sort')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_is_count')->radioList(AdPosition::getStatusOpenCloseText()) ?>
        <?= $form->field($model, 'c_status')->radioList(AdPosition::getStatusText()) ?>
    </div>
    <div class="modal-footer">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '编辑', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
