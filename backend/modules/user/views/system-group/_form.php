<?php

use yii\helpers\Html;
use common\models\AdminRole;
use backend\widgets\ActiveForm;

if ($model->isNewRecord) {
    $model->c_status = 1;
    $model->c_sort = 0;
}
?>
<div class="box box-primary">
        <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?= $form->field($model, 'c_title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_sort')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'c_status')->radioList(AdminRole::getStatusText()) ?>
    </div>
    <div class="modal-footer">
    <?= Html::submitButton($model->isNewRecord ? '新增' : '编辑', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>
</div>
