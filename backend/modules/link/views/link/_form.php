<?php

use yii\helpers\Html;
use backend\widgets\ActiveForm;
use common\widgets\uploader\Uploader;
use common\models\Link;

if ($model->isNewRecord) {
    $model->c_type = $model->c_status = 1;
    $model->c_sort = 0;
}
?>
<div class="box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?= $form->field($model, 'c_type')->radioList(Link::getType()) ?>
        <?= $form->field($model, 'c_title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_url')->textInput(['maxlength' => true]) ?>
        <div class="form-group">
            <label class="col-lg-2 control-label">图片上传</label>
            <div class="col-lg-7">
                <?= Uploader::widget(['value' => $model->c_picture, 'object_id' => $model->c_id]); ?>
            </div>
        </div>
        <?= $form->field($model, 'c_note')->textArea(['maxlength' => true, 'rows' => 3]) ?>
        <?= $form->field($model, 'c_sort')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_status')->radioList(Link::getLinkStatus()) ?>
    </div>
    <div class="modal-footer">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '编辑', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
