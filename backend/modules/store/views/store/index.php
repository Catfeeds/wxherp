<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use common\extensions\Util;
use common\extensions\CheckRule;
use common\models\Store;
use common\models\Upload;
use common\models\Areas;
use backend\widgets\GridView;
use backend\widgets\SearchForm;

$this->title = '商家列表';
$get = Yii::$app->request->get();
$pagesize = isset($get['StoreSearch']['pagesize']) ? $get['StoreSearch']['pagesize'] : '';
$keyword = isset($get['StoreSearch']['keyword']) ? trim($get['StoreSearch']['keyword']) : '';
$status = isset($get['StoreSearch']['status']) ? $get['StoreSearch']['status'] : '';
$type = isset($get['StoreSearch']['type']) ? $get['StoreSearch']['type'] : '';
$is_top = isset($get['StoreSearch']['is_top']) ? $get['StoreSearch']['is_top'] : '';
$is_recommend = isset($get['StoreSearch']['is_recommend']) ? $get['StoreSearch']['is_recommend'] : '';
$is_open = isset($get['StoreSearch']['is_open']) ? $get['StoreSearch']['is_open'] : '';
$is_delete = isset($get['StoreSearch']['is_delete']) ? $get['StoreSearch']['is_delete'] : '';
$province_id = isset($get['StoreSearch']['province_id']) ? $get['StoreSearch']['province_id'] : '';
?>
<div class="box box-primary">
    <div class="box-header">
        <div class="pull-left">
            <?php $form = SearchForm::begin(); ?>
            <?= $form->field($searchModel, 'pagesize')->dropDownList(Store::getPageSize(), ['prompt' => '选择页码', 'value' => $pagesize]) ?>
            <?= $form->field($searchModel, 'status')->dropDownList(Store::getStatusText(), ['prompt' => '选择状态', 'value' => $status]) ?>
            <?= $form->field($searchModel, 'type')->dropDownList(Store::getType(), ['prompt' => '选择类别', 'value' => $type]) ?>
            <?= $form->field($searchModel, 'is_top')->dropDownList(Store::getStatusYesNoText(), ['prompt' => '是否置顶', 'value' => $is_top]) ?>
            <?= $form->field($searchModel, 'is_recommend')->dropDownList(Store::getStatusYesNoText(), ['prompt' => '是否推荐', 'value' => $is_recommend]) ?>
            <?= $form->field($searchModel, 'is_open')->dropDownList(Store::getStatusYesNoText(), ['prompt' => '是否营业', 'value' => $is_open]) ?>
            <?= $form->field($searchModel, 'is_delete')->dropDownList(Store::getStatusDeleteText(), ['prompt' => '是否删除', 'value' => $is_delete]) ?>
            <?= $form->field($searchModel, 'province_id')->dropDownList(Areas::getKeyValueCache(['c_parent_id' => 0]), ['prompt' => '选择省份', 'value' => $province_id]) ?>

            <?= $form->field($searchModel, 'keyword')->textInput(['maxlength' => true, 'placeholder' => '请输入关键词', 'value' => $keyword]) ?>
            <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('重置', Url::to(['index']), ['class' => 'btn btn-default']) ?>
            <?php SearchForm::end(); ?>
        </div>
        <?php if (CheckRule::checkRole('/store/store/create')) { ?>
            <div class="pull-right">
                <?= Html::a('<i class="fa fa-plus"></i> 新增', Url::to(['create']), ['class' => 'btn btn-success']) ?>
            </div>
        <?php } ?>
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
                    'attribute' => 'c_sort',
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
                    'attribute' => 'c_type',
                    'format' => 'raw',
                    'value' => function($model) {
                        return Store::getType($model->c_type);
                    },
                ],
                [
                    'attribute' => 'c_province_id',
                    'format' => 'raw',
                    'value' => function($model) {
                        return isset($model->province->c_title) ? $model->province->c_title : '--';
                    }
                ],
                [
                    'attribute' => 'c_city_id',
                    'format' => 'raw',
                    'value' => function($model) {
                        return isset($model->city->c_title) ? $model->city->c_title : '--';
                    }
                ],
                [
                    'attribute' => 'c_area_id',
                    'format' => 'raw',
                    'value' => function($model) {
                        return isset($model->area->c_title) ? $model->area->c_title : '--';
                    }
                ],
                [
                    'attribute' => 'c_address',
                    'format' => 'raw',
                    'value' => function($model) use($keyword) {
                        return $keyword ? Util::highlight($keyword, $model->c_address) : $model->c_address;
                    }
                ],
                [
                    'attribute' => 'c_status',
                    'format' => 'raw',
                    'value' => function($model) {
                        return Store::getStatusIcon($model->c_status);
                    },
                ],
                [
                    'attribute' => 'c_is_top',
                    'format' => 'raw',
                    'value' => function($model) {
                        return Store::getStatusYesNoIcon($model->c_is_top);
                    },
                ],
                [
                    'attribute' => 'c_is_recommend',
                    'format' => 'raw',
                    'value' => function($model) {
                        return Store::getStatusYesNoIcon($model->c_is_recommend);
                    },
                ],
                [
                    'attribute' => 'c_is_open',
                    'format' => 'raw',
                    'value' => function($model) {
                        return Store::getStatusOpenCloseIcon($model->c_is_open);
                    },
                ],
                [
                    'attribute' => 'c_is_delete',
                    'format' => 'raw',
                    'value' => function($model) {
                        return Store::getStatusDeleteIcon($model->c_is_delete);
                    },
                ],
                [
                    'attribute' => 'c_create_time',
                    'format' => ['date', 'php:Y-m-d H:i']
                ]
            ],
        ]);
        ?>
        <?php Pjax::end(); ?>
    </div>
</div>