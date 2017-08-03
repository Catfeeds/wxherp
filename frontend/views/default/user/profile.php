<?php

use yii\helpers\Html;
use frontend\widgets\ActiveForm;
use common\models\UserProfile;
?>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-address-card"></i> 个人资料</div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-7">
                <p class="form-control-static"><?= Yii::$app->user->identity->c_user_name ?></p>
            </div>
        </div>
        <?php if ($model->c_nick_name) { ?>
            <div class="form-group">
                <label class="col-sm-2 control-label">昵称</label>
                <div class="col-sm-7">
                    <p class="form-control-static"><?= $model->c_nick_name ?></p>
                </div>
            </div>
        <?php } else { ?>
            <?= $form->field($model, 'c_nick_name')->textInput(['maxlength' => true]) ?>
        <?php } ?>
        <?= $form->field($model, 'c_full_name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'c_sex')->radioList(UserProfile::getSexType()) ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">出生年月日</label>
            <div class="col-sm-7">
                <div class="row">
                    <div class="col-sm-4">
                        <?= Html::activeDropDownList($model, 'birthday_year', [], ['id' => 'select_year', 'class' => 'form-control', 'rel' => date('Y', $model->c_birthday)]) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= Html::activeDropDownList($model, 'birthday_month', [], ['id' => 'select_month', 'class' => 'form-control', 'rel' => (int) date('m', $model->c_birthday)]) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= Html::activeDropDownList($model, 'birthday_day', [], ['id' => 'select_day', 'class' => 'form-control', 'rel' => (int) date('d', $model->c_birthday)]) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">现居住地</label>
            <div class="col-sm-7">
                <div class="row">
                    <div class="col-sm-4">
                        <?= Html::activeDropDownList($model, 'c_province_id', [], ['id' => 'c_province_id']) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= Html::activeDropDownList($model, 'c_city_id', [], ['id' => 'c_city_id']) ?>
                    </div>
                    <div class="col-sm-4">
                        <?= Html::activeDropDownList($model, 'c_area_id', [], ['id' => 'c_area_id']) ?>
                    </div>
                </div>
            </div>
        </div>
        <?= $form->field($model, 'c_address')->textArea(['maxlength' => true, 'rows' => 3]) ?>
        <?= $form->field($model, 'c_sign')->textArea(['maxlength' => true, 'rows' => 3]) ?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php
$default = $model->isNewRecord ? '' : ',defVal: [' . $model->c_province_id . ',' . $model->c_city_id . ',' . $model->c_area_id . ']';
$js = <<<EOT
    $.BirthdayPicker();
    var opts = {
        data: districtData,
        selClass: 'form-control',
        minWidth: 0,
        maxWidth: 0,
        autoHide :true,
        head: '请选择',
        select: ['#c_province_id', '#c_city_id', '#c_area_id']$default
    };
    new LinkageSel(opts);
EOT;
common\assets\FrontendAsset::addScript($js);
