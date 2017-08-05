<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use common\extensions\Util;
use common\extensions\CheckRule;
use common\models\Restaurant;
use common\models\Upload;
use common\models\Areas;
use backend\widgets\GridView;
use backend\widgets\SearchForm;

$this->title = '餐厅列表';
$get = Yii::$app->request->get();
$pagesize = isset($get['RestaurantSearch']['pagesize']) ? $get['RestaurantSearch']['pagesize'] : '';
$keyword = isset($get['RestaurantSearch']['keyword']) ? trim($get['RestaurantSearch']['keyword']) : '';
$status = isset($get['RestaurantSearch']['status']) ? $get['RestaurantSearch']['status'] : '';
$type = isset($get['RestaurantSearch']['type']) ? $get['RestaurantSearch']['type'] : '';
$is_top = isset($get['RestaurantSearch']['is_top']) ? $get['RestaurantSearch']['is_top'] : '';
$is_recommend = isset($get['RestaurantSearch']['is_recommend']) ? $get['RestaurantSearch']['is_recommend'] : '';
$is_open = isset($get['RestaurantSearch']['is_open']) ? $get['RestaurantSearch']['is_open'] : '';
$is_delete = isset($get['RestaurantSearch']['is_delete']) ? $get['RestaurantSearch']['is_delete'] : '';
$province_id = isset($get['RestaurantSearch']['province_id']) ? $get['RestaurantSearch']['province_id'] : '';
?>
<div class="box box-primary">
    <div class="box-header">
        <div class="pull-left">
            <?php $form = SearchForm::begin(); ?>
            <?= $form->field($searchModel, 'pagesize')->dropDownList(Restaurant::getPageSize(), ['prompt' => '选择页码', 'value' => $pagesize]) ?>
            <?= $form->field($searchModel, 'status')->dropDownList(Restaurant::getStatusText(), ['prompt' => '选择状态', 'value' => $status]) ?>
            <?= $form->field($searchModel, 'type')->dropDownList(Restaurant::getLabel(Restaurant::LABEL_TYPE), ['prompt' => '选择类别', 'value' => $type]) ?>
            <?= $form->field($searchModel, 'is_top')->dropDownList(Restaurant::getStatusYesNoText(), ['prompt' => '是否置顶', 'value' => $is_top]) ?>
            <?= $form->field($searchModel, 'is_recommend')->dropDownList(Restaurant::getStatusYesNoText(), ['prompt' => '是否推荐', 'value' => $is_recommend]) ?>
            <?= $form->field($searchModel, 'is_open')->dropDownList(Restaurant::getStatusYesNoText(), ['prompt' => '是否营业', 'value' => $is_open]) ?>
            <?= $form->field($searchModel, 'is_delete')->dropDownList(Restaurant::getStatusDeleteText(), ['prompt' => '是否删除', 'value' => $is_delete]) ?>
            <?= $form->field($searchModel, 'province_id')->dropDownList(Areas::getKeyValueCache(['c_parent_id' => 0]), ['prompt' => '选择省份', 'value' => $province_id]) ?>

            <?= $form->field($searchModel, 'keyword')->textInput(['maxlength' => true, 'placeholder' => '请输入关键词', 'value' => $keyword]) ?>
            <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('重置', Url::to(['index']), ['class' => 'btn btn-default']) ?>
            <?php SearchForm::end(); ?>
        </div>
        <?php if (CheckRule::checkRole('/restaurant/restaurant/create')) { ?>
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
                        return Restaurant::getLabel(Restaurant::LABEL_TYPE, $model->c_type);
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
                        return Restaurant::getStatusIcon($model->c_status);
                    },
                ],
                [
                    'attribute' => 'c_is_top',
                    'format' => 'raw',
                    'value' => function($model) {
                        return Restaurant::getStatusYesNoIcon($model->c_is_top);
                    },
                ],
                [
                    'attribute' => 'c_is_recommend',
                    'format' => 'raw',
                    'value' => function($model) {
                        return Restaurant::getStatusYesNoIcon($model->c_is_recommend);
                    },
                ],
                [
                    'attribute' => 'c_is_open',
                    'format' => 'raw',
                    'value' => function($model) {
                        return Restaurant::getStatusOpenCloseIcon($model->c_is_open);
                    },
                ],
                [
                    'attribute' => 'c_is_delete',
                    'format' => 'raw',
                    'value' => function($model) {
                        return Restaurant::getStatusDeleteIcon($model->c_is_delete);
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