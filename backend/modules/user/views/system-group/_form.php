<?php

use yii\helpers\Html;
use common\models\SystemGroup;
use common\models\SystemRoute;
use common\models\SystemGroupNode;
use backend\widgets\ActiveForm;

$system_route = SystemRoute::getTreeCache();
$route_list = [];
if ($model->isNewRecord) {
    $model->c_status = 1;
    $model->c_sort = 0;
} else {
    $route_list = SystemGroupNode::getColumn('c_route_id', ['c_group_id' => $model->c_id]);
}
?>
<div class="box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <?= $form->field($model, 'c_title')->textInput(['maxlength' => true]) ?>
        <div class="form-group">
            <label class="col-lg-2 control-label">选择路由</label>
            <div class="col-lg-7">
                <ul class="nav nav-tabs">
                    <?php
                    $i = 0;
                    foreach ($system_route as $v) {
                        if ($v['c_parent_id'] == 0) {
                            ?>
                            <li<?= $i == 0 ? ' class="active"' : '' ?>><a href="#tab<?= $i ?>" data-toggle="tab"><?= $v['c_title'] ?></a></li>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                </ul>
                <div class="tab-content pt20">
                    <?php
                    $j = 0;
                    foreach ($system_route as $v) {
                        if ($v['c_parent_id'] == 0) {
                            ?>
                            <div class="tab-pane<?= $j == 0 ? ' active' : '' ?>" id="tab<?= $j ?>">
                                <?php
                                if (isset($v['sub'])) {
                                    foreach ($v['sub'] as $vv) {
                                        ?>
                                        <div class="panel panel-default">
                                            <div class="panel-heading"><?= $vv['c_title'] ?></div>
                                            <div class="panel-body">
                                                <?php
                                                if (isset($vv['sub'])) {
                                                    foreach ($vv['sub'] as $vvv) {
                                                        $selectstr = in_array($vvv['c_id'], $route_list) ? ' checked' : '';
                                                        ?>
                                                        <label class="checkbox-inline">
                                                            <input name="SystemGroup[route_list][]" type="checkbox" value="<?= $vvv['c_id'] ?>"<?= $selectstr ?>> <?= $vvv['c_title'] ?>
                                                        </label>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <?php
                            $j++;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <?= $form->field($model, 'c_sort')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_status')->radioList(SystemGroup::getStatusText()) ?>
    </div>
    <div class="modal-footer">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '编辑', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
