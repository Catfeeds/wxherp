<?php

$this->title = '消息模板新增';
$this->params['breadcrumbs'][] = ['label' => '消息模板列表', 'url' => ['index']];
echo $this->render('_form', ['model' => $model]);
