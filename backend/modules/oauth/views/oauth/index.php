<?php

use yii\widgets\Pjax;
use common\extensions\CheckRule;
use common\models\Upload;
use backend\widgets\GridView;

$this->title = '授权认证列表';
?>
<div class="box box-primary">
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
                'c_sort',
                'c_title',
                [
                    'attribute' => 'c_logo',
                    'format' => ['image'],
                    'value' => function ($model) {
                return Upload::getUploadUrl('oauth/' . $model->c_logo);
            }
                ],
                [
                    'attribute' => 'c_url',
                    'format' => 'url',
                    'value' => function($model) {
                        return $model->c_url;
                    }
                ],
                'c_description',
                [
                    'attribute' => 'c_status',
                    'format' => 'raw',
                    'value' => function($model) {
                        return Upload::getStatusIcon($model->c_status);
                    },
                ],
                [
                    'class' => 'backend\widgets\ActionColumn',
                    'header' => '管理操作',
                    'template' => '<span class="pr20">{update}</span>',
                    'visibleButtons' => [
                        'update' => CheckRule::checkRole('/oauth/oauth/update')
                    ]
                ],
            ],
        ]);
        ?>
        <?php Pjax::end(); ?>
    </div>
</div>