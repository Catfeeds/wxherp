<?php

$this->title = '用户组新增';
$this->params['breadcrumbs'][] = ['label' => '用户组列表', 'url' => ['index']];
echo $this->render('_form', ['model' => $model]);
