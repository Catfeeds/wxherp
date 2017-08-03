<?php

use yii\helpers\Html;
use frontend\widgets\ActiveForm;
use common\widgets\uploader\Uploader;
use common\widgets\editor\Editor;
use common\models\UserProfile;
use common\models\Event;
use common\models\CommonAlbum;

$album = '';
if ($model->isNewRecord) {
    $model->c_type = 1;
    $model->c_sex = 3;
    $model->c_status = 1;
} else {
    $model->c_start_time = date('Y-m-d H:i', $model->c_start_time);
    $model->c_end_time = date('Y-m-d H:i', $model->c_end_time);
    $_album = CommonAlbum::getColumn('c_path', ['c_type' => Event::TYPE_EVENT, 'c_user_id' => Yii::$app->user->id, 'c_object_id' => $model->c_id]);
    if ($_album) {
        $album = implode(',', $_album);
    }
}
?>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-<?= $model->isNewRecord ? 'plus-circle' : 'edit' ?>"></i> <?= $this->title ?></div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'c_title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_sponsor')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_max')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_type')->radioList(Event::getType()) ?>

        <div class="form-group">
            <label class="col-sm-2 control-label">活动日期</label>
            <div class="col-sm-7">
                <div class="row">
                    <div class="col-sm-4"><?= Html::activeInput('text', $model, 'c_start_time', ['class' => 'form-control form-datetime pointer', 'readonly' => 'readonly']) ?> </div>
                    <div class="col-sm-4"><?= Html::activeInput('text', $model, 'c_end_time', ['class' => 'form-control form-datetime pointer', 'readonly' => 'readonly']) ?></div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">活动地区</label>
            <div class="col-sm-7">
                <div class="row">
                    <div class="col-sm-4">
                        <?= Html::activeDropDownList($model, 'c_province_id', [], ['id' => 'c_province_id']) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= Html::activeDropDownList($model, 'c_city_id', [], ['id' => 'c_city_id']) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= Html::activeDropDownList($model, 'c_area_id', [], ['id' => 'c_area_id']) ?>
                    </div>
                </div>
            </div>
        </div>
        <?= $form->field($model, 'c_address')->textArea(['maxlength' => true, 'rows' => 3]) ?>
        <?= $form->field($model, 'c_sex')->radioList(UserProfile::getSelectSex()) ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">活动缩略图</label>
            <div class="col-sm-7">
                <?= Uploader::widget(['user_type' => 2, 'value' => $model->c_picture]); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">活动相册</label>
            <div class="col-sm-10">
                <?= Uploader::widget(['user_type' => 2, 'more' => true, 'name' => 'common_album', 'value' => $album]); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">活动详情</label>
            <div class="col-sm-10">
                <?= Editor::widget(['user_type' => 2, 'value' => $model->isNewRecord ? '' : $model->eventText->c_content, 'object_id' => $model->c_id]); ?>
            </div>
        </div>   
        <?= $form->field($model, 'c_status')->radioList(Event::getStatusText()) ?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
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
        select: ['#c_province_id', '#c_city_id', '#c_area_id']$default
    };
    new LinkageSel(opts);
EOT;
common\assets\FrontendAsset::addScript($js);