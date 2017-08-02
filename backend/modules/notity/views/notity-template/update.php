<?php

$this->title = '消息模板编辑';
$this->params['breadcrumbs'][] = ['label' => '消息模板列表', 'url' => ['index']];
echo $this->render('_form', ['model' => $model]);
