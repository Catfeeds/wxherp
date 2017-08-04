<?php

use yii\helpers\Html;
use frontend\widgets\ActiveForm;
use common\widgets\uploader\Uploader;
use common\widgets\editor\Editor;
use common\models\Article;
use common\models\ArticleCategory;
use common\models\Upload;

if ($model->isNewRecord) {
    $model->c_status = $model->c_source_type = 1;
    $model->c_author = Yii::$app->user->identity->userProfile->c_nick_name ? Yii::$app->user->identity->userProfile->c_nick_name : Yii::$app->user->identity->c_user_name;
}
?>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-<?= $model->isNewRecord ? 'plus-circle' : 'edit' ?>"></i> <?= $this->title ?></div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'c_title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_category_id')->radioList(ArticleCategory::getKeyValueCache(['c_status' => Article::STATUS_YES])) ?>
        <?= $form->field($model, 'c_source_type')->radioList(Article::getSourceType()) ?>
        <?= $form->field($model, 'c_author')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_source_url', ['options' => ['class' => 'form-group', 'style' => $model->c_source_type == 1 ? 'display:none' : '']])->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <label class="col-sm-2 control-label">文章缩略图</label>
            <div class="col-sm-7">
                <?= Uploader::widget(['value' => $model->c_picture, 'object_id' => $model->c_id, 'object_type' => Article::OBJECT_ARTICLE]); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">文章相册</label>
            <div class="col-sm-10">
                <?= Uploader::widget(['value' => Upload::getPath($model->c_id, Article::OBJECT_ARTICLE_MORE), 'object_id' => $model->c_id, 'object_type' => Article::OBJECT_ARTICLE_MORE]); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">文章正文</label>
            <div class="col-sm-10">
                <?= Editor::widget(['value' => isset($model->articleText->c_content) ? $model->articleText->c_content : '', 'object_id' => $model->c_id, 'object_type' => Article::OBJECT_ARTICLE_EDITOR]); ?>
            </div>
        </div>   
        <?= $form->field($model, 'c_status')->radioList(Article::getStatusText()) ?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
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
common\assets\FrontendAsset::addScript($js);
