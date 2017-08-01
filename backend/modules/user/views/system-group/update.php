<?php

$this->title = '管理组编辑';
$this->params['breadcrumbs'][] = ['label' => '管理组列表', 'url' => ['index']];
echo $this->render('_form', ['model' => $model]);
