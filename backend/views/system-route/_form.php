<?php

use yii\helpers\Html;
use common\models\SystemRoute;
use backend\widgets\ActiveForm;

$dropdown = SystemRoute::formatDropDownList();
$dropdown[0] = '顶级菜单';
$defaul_icon = 'option-horizontal';
if ($model->isNewRecord) {
    $model->c_status = 1;
    $model->c_sort = 0;
    $model->c_parent_id = (int) Yii::$app->request->get('parent_id', 0);
} else {
    $defaul_icon = $model->c_icon ? $model->c_icon : $defaul_icon;
}
?>
<div class="box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?= $form->field($model, 'c_parent_id')->dropDownList($dropdown) ?>
        <?= $form->field($model, 'c_title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_route')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_icon', ['template' => '{label}<div class="col-lg-7">{input}<div class="help-block">不带fa fa- <a href=" http://fontawesome.io/icons/" target="_blank">查看图标</a></div></div>'])->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_sort')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_status')->radioList(SystemRoute::getStatusText()) ?>
    </div>
    <div class="modal-footer">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '编辑', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>