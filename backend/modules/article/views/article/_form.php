<?php

use yii\helpers\Html;
use common\widgets\uploader\Uploader;
use common\widgets\editor\Editor;
use common\models\Article;
use common\models\ArticleCategory;
use common\models\Upload;
use backend\widgets\ActiveForm;

if ($model->isNewRecord) {
    $model->c_status = $model->c_source_type = 1;
}
?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">基本信息</a></li>
    <li><a href="#tab2" data-toggle="tab">上传图片</a></li>
    <li><a href="#tab3" data-toggle="tab">正文内容</a></li>
    <li><a href="#tab4" data-toggle="tab">优化设置</a></li>
</ul>
<div class="box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body tab-content">
        <div class="tab-pane active" id="tab1">
            <?= $form->field($model, 'c_title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'c_category_id')->dropDownList(ArticleCategory::formatDropDownList(), ['prompt' => '选择类别']) ?>
            <?= $form->field($model, 'c_source_type')->radioList(Article::getSourceType()) ?>
            <?= $form->field($model, 'c_author')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'c_source_url', ['options' => ['class' => 'form-group', 'style' => $model->c_source_type == 1 ? 'display:none' : '']])->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'c_status')->radioList(Article::getStatusText()) ?>
        </div>
        <div class="tab-pane" id="tab2">
            <div class="form-group">
                <label class="col-lg-2 control-label">文章缩略图</label>
                <div class="col-lg-7">
                    <?= Uploader::widget(['value' => $model->c_picture, 'object_id' => $model->c_id, 'object_type' => Article::OBJECT_ARTICLE]); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">文章相册</label>
                <div class="col-lg-7">
                    <?= Uploader::widget(['value' => Upload::getPath($model->c_id, Article::OBJECT_ARTICLE_MORE), 'object_id' => $model->c_id, 'object_type' => Article::OBJECT_ARTICLE_MORE]); ?>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab3">
            <div class="field-content-c_pc_content form-group">
                <label class="col-lg-2 control-label">文章正文</label>
                <div class="col-lg-7">
                    <?= Editor::widget(['value' => isset($model->articleText->c_content) ? $model->articleText->c_content : '', 'object_id' => $model->c_id, 'object_type' => Article::OBJECT_ARTICLE_EDITOR]); ?>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab4">
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
<?php
$js = <<<EOT
    $(function () {
        function setShowHide(type) {
            if (type === '1') {
                $('.field-article-c_source_url').hide();
            } else if (type === '2') {
               $('.field-article-c_source_url').show();
            } 
        }
        $('.field-article-c_source_type input').on('click', function () {
            setShowHide($(this).val());
        });
    });
EOT;
common\assets\BackendAsset::addScript($js);
