<?php

$this->title = '用户组编辑';
$this->params['breadcrumbs'][] = ['label' => '用户组列表', 'url' => ['index']];
echo $this->render('_form', ['model' => $model]);
