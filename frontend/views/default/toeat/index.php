<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use common\extensions\Util;
use common\models\Upload;
use common\models\Event;
use frontend\widgets\GridView;
use frontend\widgets\SearchForm;

$this->title = '我的活动';
$get = Yii::$app->request->get();
$keyword = isset($get['EventSearch']['keyword']) ? trim($get['EventSearch']['keyword']) : '';
$status = isset($get['EventSearch']['status']) ? $get['EventSearch']['status'] : '';
$type = isset($get['EventSearch']['type']) ? $get['EventSearch']['type'] : '';
?>
<div class="panel panel-default">
    <div class="panel-heading"><div class="pull-right"><a href="<?= Url::to(['create']); ?>"><i class="fa fa-plus-circle"></i> 新增活动</a></div><i class="fa fa-calendar-o"></i> 我的活动</div>
    <div class="panel-body">
        <?php $form = SearchForm::begin(); ?>
        <?= $form->field($searchModel, 'status')->dropDownList(Event::getStatusText(), ['prompt' => '选择状态', 'value' => $status]) ?>
        <?= $form->field($searchModel, 'type')->dropDownList(Event::getType(), ['prompt' => '选择类型', 'value' => $type]) ?>
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
                    'attribute' => 'c_sponsor',
                    'format' => 'raw',
                    'value' => function($model) use($keyword) {
                        return $keyword ? Util::highlight($keyword, $model->c_sponsor) : $model->c_sponsor;
                    }
                ],
                [
                    'attribute' => 'c_type',
                    'format' => 'raw',
                    'value' => function($model) {
                        return Event::getType($model->c_type);
                    },
                ],
                [
                    'attribute' => 'c_status',
                    'format' => 'raw',
                    'value' => function($model) {
                        return Event::getStatusIcon($model->c_status);
                    },
                ],
                [
                    'attribute' => 'c_create_time',
                    'format' => ['date', 'php:Y-m-d H:i:s']
                ],
                [
                    'class' => 'frontend\widgets\ActionColumn',
                    'header' => '管理操作',
                    'template' => '<span class="pr20">{update}</span><span class="pr20">{delete}</span>',
                    'visibleButtons' => [
                        'delete' => function ($model) {
                            return $model->c_status == Event::STATUS_YES;
                        },
                    ]
                ],
            ],
        ]);
        ?>
        <?php Pjax::end(); ?>
    </div>
</div>


