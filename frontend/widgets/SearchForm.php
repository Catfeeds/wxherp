<?php

namespace frontend\widgets;

use yii\widgets\ActiveForm as YiiActiveForm;

class SearchForm extends YiiActiveForm {

    public $enableClientValidation = false;
    public $method = 'get';
    public $options = ['class' => 'form-inline mb15'];
    public $fieldConfig = ['template' => '{input}'];

}
