<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use common\extensions\Util;
use common\extensions\CheckRule;
use common\models\Article;
use common\models\ArticleCategory;
use common\models\Upload;
use backend\widgets\GridView;
use backend\widgets\SearchForm;

$this->title = '文章列表';
$get = Yii::$app->request->get();
$pagesize = isset($get['ArticleSearch']['pagesize']) ? $get['ArticleSearch']['pagesize'] : '';
$keyword = isset($get['ArticleSearch']['keyword']) ? trim($get['ArticleSearch']['keyword']) : '';
$status = isset($get['ArticleSearch']['status']) ? $get['ArticleSearch']['status'] : '';
$category_id = isset($get['ArticleSearch']['category_id']) ? $get['ArticleSearch']['category_id'] : '';
?>
<div class="box box-primary">
    <div class="box-header">
        <div class="pull-left">
            <?php $form = SearchForm::begin(); ?>
            <?= $form->field($searchModel, 'pagesize')->dropDownList(Article::getPageSize(), ['prompt' => '选择页码', 'value' => $pagesize]) ?>
            <?= $form->field($searchModel, 'status')->dropDownList(Article::getStatusText(), ['prompt' => '选择状态', 'value' => $status]) ?>
            <?= $form->field($searchModel, 'category_id')->dropDownList(ArticleCategory::formatDropDownListCache(), ['prompt' => '选择类别', 'value' => $category_id]) ?>
            <?= $form->field($searchModel, 'keyword')->textInput(['maxlength' => true, 'placeholder' => '请输入关键词', 'value' => $keyword]) ?>
            <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('重置', Url::to(['index']), ['class' => 'btn btn-default']) ?>
            <?php SearchForm::end(); ?>
        </div>
    </div>
    <div class="box-body">
        <?php Pjax::begin(); ?> 
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'attribute' => 'c_id',
                    'headerOptions' => ['style' => 'min-width:50px']
                ],
                [
                    'attribute' => 'c_picture',
                    'format' => ['image', ['height' => 50]],
                    'value' => function ($model) {
                return Upload::getThumb($model->c_picture);
            }
                ],
                [
                    'attribute' => 'c_title',
                    'format' => 'raw',
                    'value' => function($model) use($keyword) {
                        return $keyword ? Util::highlight($keyword, $model->c_title) : $model->c_title;
                    }
                ],
                [
                    'attribute' => 'c_category_id',
                    'format' => 'raw',
                    'value' => function($model) {
                        return isset($model->articleCategory->c_title) ? $model->articleCategory->c_title : '--';
                    },
                ],
                [
                    'attribute' => 'c_author',
                    'format' => 'raw',
                    'value' => function($model) use($keyword) {
                        return $keyword ? Util::highlight($keyword, $model->c_author) : $model->c_author;
                    }
                ],
                [
                    'attribute' => 'c_source_type',
                    'format' => 'raw',
                    'value' => function($model) {
                        return Article::getSourceType($model->c_source_type);
                    },
                ],
                [
                    'attribute' => 'c_status',
                    'format' => 'raw',
                    'value' => function($model) {
                        return Article::getStatusIcon($model->c_status);
                    },
                ],
                [
                    'attribute' => 'c_create_time',
                    'format' => ['date', 'php:Y-m-d H:i']
                ],
                [
                    'class' => 'backend\widgets\ActionColumn',
                    'header' => '管理操作',
                    'template' => '<span class="pr20">{delete}</span>',
                ],
            ],
        ]);
        ?>
        <?php Pjax::end(); ?>
    </div>
</div>