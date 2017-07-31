<?php

use yii\helpers\Html;
use backend\widgets\ActiveForm;

$this->title = '个人资料编辑';
?>
<div class="box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?= $form->field($model, 'c_mobile')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_email')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="modal-footer">
        <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
