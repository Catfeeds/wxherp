<?php

$this->title = '链接新增';
$this->params['breadcrumbs'][] = ['label' => '链接列表', 'url' => ['index']];
echo $this->render('_form', ['model' => $model]);
