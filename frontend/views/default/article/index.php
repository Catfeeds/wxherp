<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use common\extensions\Util;
use common\models\Upload;
use common\models\Article;
use common\models\ArticleCategory;
use frontend\widgets\GridView;
use frontend\widgets\SearchForm;

$this->title = '我发布的文章';
$get = Yii::$app->request->get();
$keyword = isset($get['ArticleSearch']['keyword']) ? trim($get['ArticleSearch']['keyword']) : '';
$status = isset($get['ArticleSearch']['status']) ? $get['ArticleSearch']['status'] : '';
$category_id = isset($get['ArticleSearch']['category_id']) ? $get['ArticleSearch']['category_id'] : '';
?>
<div class="panel panel-default">
    <div class="panel-heading"><div class="pull-right"><a href="<?= Url::to(['create']); ?>"><i class="fa fa-plus-circle"></i> 新增</a></div><i class="fa fa-calendar-o"></i> <?= $this->title ?></div>
    <div class="panel-body">
        <?php $form = SearchForm::begin(); ?>
        <?= $form->field($searchModel, 'status')->dropDownList(Article::getStatusText(), ['prompt' => '选择状态', 'value' => $status]) ?>
        <?= $form->field($searchModel, 'category_id')->dropDownList(ArticleCategory::getKeyValueCache(['c_status' => Article::STATUS_YES]), ['prompt' => '选择类别', 'value' => $category_id]) ?>
        <?= $form->field($searchModel, 'keyword')->textInput(['maxlength' => true, 'placeholder' => '请输入关键词', 'value' => $keyword]) ?>
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('重置', Url::to(['index']), ['class' => 'btn btn-default']) ?>
        <?php SearchForm::end(); ?>
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
                    'class' => 'frontend\widgets\ActionColumn',
                    'header' => '管理操作',
                    'template' => '<span class="pr20">{update}</span><span class="pr20">{delete}</span>',
                    'visibleButtons' => [
                        'delete' => function ($model) {
                            return $model->c_status == Article::STATUS_YES;
                        },
                    ]
                ],
            ],
        ]);
        ?>
        <?php Pjax::end(); ?>
    </div>
</div>


