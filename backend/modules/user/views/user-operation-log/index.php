<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use common\extensions\Util;
use common\models\UserOperationLog;
use backend\widgets\GridView;
use backend\widgets\SearchForm;

$this->title = '用户操作记录';
$get = Yii::$app->request->get();
$pagesize = isset($get['UserOperationLogSearch']['pagesize']) ? $get['UserOperationLogSearch']['pagesize'] : '';
$keyword = isset($get['UserOperationLogSearch']['keyword']) ? trim($get['UserOperationLogSearch']['keyword']) : '';
$status = isset($get['UserOperationLogSearch']['status']) ? $get['UserOperationLogSearch']['status'] : '';
$type = isset($get['UserOperationLogSearch']['type']) ? $get['UserOperationLogSearch']['type'] : '';
$create_type = isset($get['UserOperationLogSearch']['create_type']) ? $get['UserOperationLogSearch']['create_type'] : '';
?>
<div class="box box-primary">
    <div class="box-header">
        <div class="pull-left">
            <?php $form = SearchForm::begin(); ?>
            <?= $form->field($searchModel, 'pagesize')->dropDownList(UserOperationLog::getPageSize(), ['prompt' => '选择页码', 'value' => $pagesize]) ?>
            <?= $form->field($searchModel, 'status')->dropDownList(UserOperationLog::getStatusText(), ['prompt' => '选择状态', 'value' => $status]) ?>
            <?= $form->field($searchModel, 'type')->dropDownList(UserOperationLog::getOperationType(), ['prompt' => '选择类型', 'value' => $type]) ?>
            <?= $form->field($searchModel, 'create_type')->dropDownList(UserOperationLog::getCreateType(), ['prompt' => '选择来源类型', 'value' => $type]) ?>
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
                    'attribute' => 'c_route',
                    'format' => 'raw',
                    'value' => function($model) use($keyword) {
                        return $keyword ? Util::highlight($keyword, $model->c_route) : $model->c_route;
                    }
                ],
                [
                    'attribute' => 'c_type',
                    'format' => 'raw',
                    'value' => function($model) {
                        return UserOperationLog::getOperationType($model->c_type);
                    },
                ],
                [
                    'attribute' => 'c_create_type',
                    'format' => 'raw',
                    'value' => function($model) {
                        return UserOperationLog::getCreateType($model->c_create_type);
                    },
                ],
                'c_object_id',
                [
                    'attribute' => 'c_user_name',
                    'format' => 'raw',
                    'value' => function($model) use($keyword) {
                        return $keyword ? Util::highlight($keyword, $model->c_user_name) : $model->c_user_name;
                    }
                ],
                [
                    'attribute' => 'c_status',
                    'format' => 'raw',
                    'value' => function($model) {
                        return UserOperationLog::getStatusIcon($model->c_status);
                    },
                ],
                [
                    'attribute' => 'c_data_before',
                    'format' => 'raw',
                    'value' => function($model) {
                        return $model->c_data_before ? '<span title="' . htmlentities(print_r(json_decode($model->c_data_before, true), true)) . '">移动鼠标查看</span>' : '--';
                    }
                ],
                [
                    'attribute' => 'c_data_add',
                    'format' => 'raw',
                    'value' => function($model) {
                        return $model->c_data_add ? '<span title="' . htmlentities(print_r(json_decode($model->c_data_add, true), true)) . '">移动鼠标查看</span>' : '--';
                    }
                ],
                [
                    'attribute' => 'c_create_time',
                    'format' => ['date', 'php:Y-m-d H:i:s']
                ]
            ],
        ]);
        ?>
        <?php Pjax::end(); ?>
    </div>
</div>