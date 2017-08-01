<?php

$this->title = '角色编辑';
$this->params['breadcrumbs'][] = ['label' => '角色列表', 'url' => ['index']];
echo $this->render('_form', ['model' => $model]);
