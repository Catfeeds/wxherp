<?php

use yii\helpers\Html;
use common\models\Payment;
use backend\widgets\ActiveForm;

$this->title = '支付方式编辑';
$this->params['breadcrumbs'][] = ['label' => '支付方式列表', 'url' => ['index']];
?>
<div class="box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?= $form->field($model, 'c_title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_description')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_poundage_type')->radioList(Payment::getPoundageType()) ?>
        <?= $form->field($model, 'c_poundage')->textInput(['maxlength' => true])->label($model->c_poundage_type == 1 ? '商品总额的百分比' : '固定收取的手续费') ?>
        <?= $form->field($model, 'c_client_type')->radioList(Payment::getClientType()) ?>
        <?= $form->field($model, 'c_content')->textArea(['maxlength' => true, 'rows' => 3]) ?>
        <?= $form->field($model, 'c_sort')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_status')->radioList(Payment::getStatusText()) ?>
    </div>
    <div class="modal-footer">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '编辑', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$js = <<<EOT
    function setPoundage(type) {
        if (type === '1') {
            $('.field-payment-c_poundage label').text('商品总额的百分比');
        } else {
            $('.field-payment-c_poundage label').text('固定收取的手续费');
        }
    }
    $(function () {
        $('#payment-c_poundage_type input').on('click', function () {
            setPoundage($(this).val());
        });
    });
EOT;
common\assets\BackendAsset::addScript($js);
?>  
