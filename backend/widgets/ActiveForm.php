<?php

namespace backend\widgets;

use yii\widgets\ActiveForm as YiiActiveForm;

class ActiveForm extends YiiActiveForm {

    public $options = ['class' => 'form-horizontal'];
    public $fieldConfig = [
        'template' => '{label}<div class="col-lg-7">{input}</div><div class="col-lg-3">{error}</div>',
        'labelOptions' => ['class' => 'col-lg-2 control-label'], //修改label的样式
    ];

}
