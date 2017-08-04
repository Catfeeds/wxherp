<?php

use yii\helpers\Html;
use common\widgets\uploader\Uploader;
use common\widgets\editor\Editor;
use common\models\Event;
use common\models\Upload;
use backend\widgets\ActiveForm;

if ($model->isNewRecord) {
    $model->c_status = 1;
    $model->c_sort = 0;
    $model->c_sponsor = Yii::$app->user->identity->c_user_name;
}
?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">基本信息</a></li>
    <li><a href="#tab2" data-toggle="tab">上传图片</a></li>
    <li><a href="#tab3" data-toggle="tab">正文内容</a></li>
    <li><a href="#tab4" data-toggle="tab">优化设置</a></li>
</ul>
<div class="box box-primary">
    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal editer_form']]); ?>
    <div class="box-body tab-content">
        <div class="tab-pane active" id="tab1">
            <?= $form->field($model, 'c_title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'c_type')->dropDownList(Event::getType(), ['prompt' => '选择类别']) ?>
            <?= $form->datetime($model, 'c_start_time'); ?>
            <?= $form->datetime($model, 'c_end_time'); ?>
            <div class="form-group">
                <label class="col-lg-2 control-label">选择省市县</label>
                <div class="col-lg-7">
                    <div class="row">
                        <?= $form->select($model, 'c_province_id') ?>
                        <?= $form->select($model, 'c_city_id') ?>
                        <?= $form->select($model, 'c_area_id') ?>
                    </div>
                </div>
            </div>
            <?= $form->field($model, 'c_address')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'c_sponsor')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'c_max')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'c_status')->radioList(Event::getStatusText()) ?>
        </div>
        <div class="tab-pane" id="tab2">
            <div class="form-group">
                <label class="col-lg-2 control-label">活动缩略图</label>
                <div class="col-lg-7">
                    <?= Uploader::widget(['value' => $model->c_picture, 'object_id' => $model->c_id, 'object_type' => Event::OBJECT_EVENT]); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">活动相册</label>
                <div class="col-lg-7">
                    <?= Uploader::widget(['value' => Upload::getPath($model->c_id, Event::OBJECT_ARTICLE_MORE), 'object_id' => $model->c_id, 'object_type' => Event::OBJECT_EVENT_MORE]); ?>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab3">
            <div class="field-content-c_pc_content form-group">
                <label class="col-lg-2 control-label">活动详情</label>
                <div class="col-lg-7">
                    <?= Editor::widget(['value' => isset($model->eventText->c_content) ? $model->eventText->c_content : '', 'object_id' => $model->c_id, 'object_type' => Event::OBJECT_EVENT_EDITOR]); ?>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab4">
            <?= $form->field($model, 'c_sort')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'c_seo')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'c_keyword')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'c_description')->textArea(['maxlength' => true, 'rows' => 3]) ?>
        </div>
    </div>
    <div class="modal-footer">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '编辑', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$default = $model->isNewRecord ? '' : ',defVal: [' . $model->c_province_id . ',' . $model->c_city_id . ',' . $model->c_area_id . ']';
$js = <<<EOT
    var opts = {
        data: districtData,
        selClass: 'form-control',
        minWidth: 0,
        maxWidth: 0,
        autoHide :true,
        head: '请选择',
        select: ['#event-c_province_id', '#event-c_city_id', '#event-c_area_id']$default
    };
    new LinkageSel(opts);
EOT;
common\assets\BackendAsset::addScript($js);
