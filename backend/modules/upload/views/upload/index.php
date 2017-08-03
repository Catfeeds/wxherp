<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use common\extensions\Util;
use common\extensions\CheckRule;
use common\models\Upload;
use backend\widgets\GridView;
use backend\widgets\SearchForm;

$this->title = '附件列表';
$get = Yii::$app->request->get();
$pagesize = isset($get['UploadSearch']['pagesize']) ? $get['UploadSearch']['pagesize'] : '';
$keyword = isset($get['UploadSearch']['keyword']) ? trim($get['UploadSearch']['keyword']) : '';
$status = isset($get['UploadSearch']['status']) ? $get['UploadSearch']['status'] : '';
$type = isset($get['UploadSearch']['type']) ? $get['UploadSearch']['type'] : '';
$object_type = isset($get['UploadSearch']['object_type']) ? $get['UploadSearch']['object_type'] : '';
$create_type = isset($get['UploadSearch']['create_type']) ? $get['UploadSearch']['create_type'] : '';
?>
<div class="box box-primary">
    <div class="box-header">
        <div class="pull-left">
            <?php $form = SearchForm::begin(); ?>
            <?= $form->field($searchModel, 'pagesize')->dropDownList(Upload::getPageSize(), ['prompt' => '选择页码', 'value' => $pagesize]) ?>
            <?= $form->field($searchModel, 'status')->dropDownList(Upload::getStatusText(), ['prompt' => '选择状态', 'value' => $status]) ?>
            <?= $form->field($searchModel, 'type')->dropDownList(Upload::getType(), ['prompt' => '选择类型', 'value' => $type]) ?>
            <?= $form->field($searchModel, 'object_type')->dropDownList(Upload::getObjectType(), ['prompt' => '选择类型', 'value' => $object_type]) ?>
            <?= $form->field($searchModel, 'create_type')->dropDownList(Upload::getCreateType(), ['prompt' => '选择类型', 'value' => $create_type]) ?>
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
                    'attribute' => 'c_title',
                    'format' => 'raw',
                    'value' => function($model) use($keyword) {
                        return $keyword ? Util::highlight($keyword, $model->c_title) : $model->c_title;
                    }
                ],
                [
                    'attribute' => 'c_path',
                    'format' => 'raw',
                    'value' => function($model) use($keyword) {
                        return $keyword ? Util::highlight($keyword, $model->c_path) : $model->c_path;
                    }
                ],
                [
                    'attribute' => 'c_path',
                    'format' => ['image', ['height' => 50]],
                    'value' => function ($model) {
                return Upload::getThumb($model->c_path);
            }
                ],
                [
                    'attribute' => 'c_type',
                    'format' => 'raw',
                    'value' => function($model) {
                        return Upload::getType($model->c_type);
                    },
                ],
                [
                    'attribute' => 'c_create_type',
                    'format' => 'raw',
                    'value' => function($model) {
                        return Upload::getCreateType($model->c_create_type);
                    },
                ],
                [
                    'attribute' => 'c_object_type',
                    'format' => 'raw',
                    'value' => function($model) {
                        return Upload::getObjectType($model->c_object_type);
                    },
                ],
                [
                    'attribute' => 'c_status',
                    'format' => 'raw',
                    'value' => function($model) {
                        return Upload::getStatusText($model->c_status);
                    },
                ],
                [
                    'attribute' => 'c_create_time',
                    'format' => ['date', 'php:Y-m-d H:i:s']
                ],
                [
                    'class' => 'backend\widgets\ActionColumn',
                    'header' => '管理操作',
                    'template' => '<span class="pr20">{delete}</span>',
                    'visibleButtons' => [
                        'delete' => CheckRule::checkRole('/upload/upload/delete')
                    ]
                ],
            ],
        ]);
        ?>
        <?php Pjax::end(); ?>
    </div>
</div>