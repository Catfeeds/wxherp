<?php

$this->title = '用户新增';
$this->params['breadcrumbs'][] = ['label' => '用户列表', 'url' => ['index']];
echo $this->render('_form', ['model' => $model]);
