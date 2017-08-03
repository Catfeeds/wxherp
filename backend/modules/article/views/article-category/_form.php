<?php

use yii\helpers\Html;
use common\widgets\uploader\Uploader;
use common\models\ArticleCategory;
use backend\widgets\ActiveForm;

$dropdown = ArticleCategory::formatDropDownList();
$dropdown[0] = '顶级菜单';
if ($model->isNewRecord) {
    $model->c_status = 1;
    $model->c_sort = 0;
    $model->c_parent_id = (int) Yii::$app->request->get('parent_id', 0);
}
?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">基本信息</a></li>
    <li><a href="#tab2" data-toggle="tab">图片上传</a></li>
    <li><a href="#tab3" data-toggle="tab">优化设置</a></li>
</ul>
<div class="box box-primary">
    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal editer_form']]); ?>
    <div class="box-body tab-content">
        <div class="tab-pane active" id="tab1">
            <?= $form->field($model, 'c_parent_id')->dropDownList($dropdown) ?>
            <?= $form->field($model, 'c_title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'c_status')->radioList(ArticleCategory::getStatusText()) ?>
        </div>
        <div class="tab-pane" id="tab2">
            <div class="form-group">
                <label class="col-lg-2 control-label">图片上传</label>
                <div class="col-lg-7">
                    <?= Uploader::widget(['value' => $model->c_picture, 'object_id' => $model->c_id, 'object_type' => ArticleCategory::OBJECT_ARTICLE_CATEGORY]); ?>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab3">
            <?= $form->field($model, 'c_sort')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'c_short')->textInput(['maxlength' => true]) ?>
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