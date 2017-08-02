<?php

use yii\helpers\Html;
use common\widgets\uploader\Uploader;
use common\models\AdPosition;
use common\models\AdManage;
use backend\widgets\ActiveForm;

if ($model->isNewRecord) {
    $model->c_type = $model->c_status = 1;
    $model->c_sort = 0;
}
?>
<div class="box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?= $form->field($model, 'c_position_id')->dropDownList(AdPosition::getKeyValueCache(), ['prompt' => '选择广告位']) ?>
        <?= $form->field($model, 'c_type')->radioList(AdManage::getAdType()) ?>
        <?= $form->field($model, 'c_title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_url', ['options' => ['class' => 'form-group', 'style' => $model->c_type == 1 ? '' : 'display:none']])->textInput(['maxlength' => true]) ?>
        <div class="field-admanage-c_picture form-group"<?= $model->c_type == 2 ? '' : ' style="display:none"' ?>>
            <label class="col-lg-2 control-label">图片上传</label>
            <div class="col-lg-7">
                <?= Uploader::widget(['value' => $model->c_content, 'object_id' => $model->c_id, 'object_type' => AdManage::OBJECT_AD]); ?>
            </div>
        </div>
        <div class="field-admanage-c_flash form-group"<?= $model->c_type == 3 ? '' : ' style="display:none"' ?>>
            <label class="col-lg-2 control-label">Flash上传</label>
            <div class="col-lg-7">
                <?= Uploader::widget(['is_file' => true, 'value' => $model->c_content, 'object_id' => $model->c_id, 'object_type' => AdManage::OBJECT_AD]); ?>
            </div>
        </div>
        <?= $form->field($model, 'c_content', ['options' => ['class' => 'form-group', 'style' => $model->c_type == 4 ? '' : 'display:none']])->textArea(['maxlength' => true, 'rows' => 3]) ?>
        <?= $form->field($model, 'c_sort')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_status')->radioList(AdManage::getStatusText()) ?>
    </div>
    <div class="modal-footer">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '编辑', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$js = <<<EOT
    $(function () {
        function setShowHide(type) {
            var url = $('.field-admanage-c_url');
            var picture = $('.field-admanage-c_picture');
            var flash = $('.field-admanage-c_flash');
            var html = $('.field-admanage-c_content');
            if (type === '1') {
                url.show();
                picture.hide();
                flash.hide();
                html.hide();
            } else if (type === '2') {
                url.hide();
                picture.show();
                flash.hide();
                html.hide();
            } else if (type === '3') {
                url.hide();
                picture.hide();
                flash.show();
                html.hide();
            } else if (type === '4') {
                url.hide();
                picture.hide();
                flash.hide();
                html.show();
            }
        }
        $('#admanage-c_type input').on('click', function () {
            setShowHide($(this).val());
        });
    });
EOT;
common\assets\BackendAsset::addScript($js);
