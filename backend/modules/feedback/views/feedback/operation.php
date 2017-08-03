<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Feedback;
use common\models\UserProfile;
use backend\widgets\ActiveForm;

$this->title = '处理反馈';
$this->params['breadcrumbs'][] = ['label' => '反馈列表', 'url' => ['index']];
?>
<div class="box box-primary">
    <div class="box-body">
        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'c_id',
                'c_user_name',
                ['label' => $model->getAttributeLabel('c_sex'), 'value' => UserProfile::getSex($model->c_sex)],
                'c_mobile',
                'c_phone',
                'c_email',
                'c_title',
                ['label' => '咨询内容', 'value' => isset($model->feedbackText) ? $model->feedbackText->c_content : '--'],
                ['label' => $model->getAttributeLabel('c_create_time'), 'value' => date('Y-m-d H:i:s', $model->c_create_time)],
                'c_update_time',
            ],
        ])
        ?>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?= $form->field($model, 'c_status')->radioList(Feedback::getStatus()) ?>
    </div>
    <div class="modal-footer">
        <?= Html::submitButton('回复反馈', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
