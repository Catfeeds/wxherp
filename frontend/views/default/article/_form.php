<?php

use yii\helpers\Html;
use frontend\widgets\ActiveForm;
use common\widgets\uploader\Uploader;
use common\widgets\editor\Editor;
use common\models\Article;
use common\models\ArticleCategory;
use common\models\CommonAlbum;

$album = '';
if ($model->isNewRecord) {
    $model->c_status = $model->c_source_type = 1;
    $model->c_author = Yii::$app->user->identity->userProfile->c_nick_name ? Yii::$app->user->identity->userProfile->c_nick_name : Yii::$app->user->identity->c_user_name;
} else {
    $_album = CommonAlbum::getColumn('c_path', ['c_type' => Article::TYPE_ARTICLE, 'c_user_id' => Yii::$app->user->id, 'c_object_id' => $model->c_id]);
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
        <?= $form->field($model, 'c_category_id')->radioList(ArticleCategory::getKeyValueCache(['c_status' => Article::STATUS_YES])) ?>
        <?= $form->field($model, 'c_source_type')->radioList(Article::getSourceType()) ?>
        <?= $form->field($model, 'c_author')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'c_source_url', ['options' => ['class' => 'form-group', 'style' => $model->c_source_type == 1 ? 'display:none' : '']])->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <label class="col-sm-2 control-label">文章缩略图</label>
            <div class="col-sm-7">
<?= Uploader::widget(['user_type' => 2, 'value' => $model->c_picture]); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">文章相册</label>
            <div class="col-sm-10">
<?= Uploader::widget(['user_type' => 2, 'more' => true, 'name' => 'common_album', 'value' => $album]); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">文章正文</label>
            <div class="col-sm-10">
<?= Editor::widget(['user_type' => 2, 'value' => $model->isNewRecord ? '' : $model->articleText->c_content, 'object_id' => $model->c_id]); ?>
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
