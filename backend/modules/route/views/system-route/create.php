<?php

$this->title = '路由新增';
$this->params['breadcrumbs'][] = ['label' => '路由列表', 'url' => ['index']];
echo $this->render('_form', ['model' => $model]);
