<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use common\extensions\Util;
use common\extensions\CheckRule;
use common\models\EventUser;
use backend\widgets\GridView;
use backend\widgets\SearchForm;

$this->title = '活动用户列表';
$get = Yii::$app->request->get();
$pagesize = isset($get['EventUserSearch']['pagesize']) ? $get['EventUserSearch']['pagesize'] : '';
$keyword = isset($get['EventUserSearch']['keyword']) ? trim($get['EventUserSearch']['keyword']) : '';
$status = isset($get['EventUserSearch']['status']) ? $get['EventUserSearch']['status'] : '';
?>
<div class="box box-primary">
    <div class="box-header">
        <div class="pull-left">
            <?php $form = SearchForm::begin(); ?>
            <?= $form->field($searchModel, 'pagesize')->dropDownList(EventUser::getPageSize(), ['prompt' => '选择页码', 'value' => $pagesize]) ?>
            <?= $form->field($searchModel, 'status')->dropDownList(EventUser::getStatusText(), ['prompt' => '选择状态', 'value' => $status]) ?>
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
                    'label' => '活动名称',
                    'attribute' => 'c_event_id',
                    'format' => 'raw',
                    'value' => function($model) {
                        return isset($model->event->c_title) ? $model->event->c_title : '--';
                    },
                ],
                [
                    'attribute' => 'c_user_name',
                    'format' => 'raw',
                    'value' => function($model) use($keyword) {
                        return $keyword ? Util::highlight($keyword, $model->c_user_name) : $model->c_user_name;
                    }
                ],
                [
                    'attribute' => 'c_mobile',
                    'format' => 'raw',
                    'value' => function($model) use($keyword) {
                        return $keyword ? Util::highlight($keyword, $model->c_mobile) : $model->c_mobile;
                    }
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
                    'format' => ['date', 'php:Y-m-d H:i']
                ],
                [
                    'class' => 'backend\widgets\ActionColumn',
                    'header' => '管理操作',
                    'template' => '<span class="pr20">{delete}</span>',
                    'visibleButtons' => [
                        'delete' => CheckRule::checkRole('/event/user/delete')
                    ]
                ],
            ],
        ]);
        ?>
        <?php Pjax::end(); ?>
    </div>
</div>