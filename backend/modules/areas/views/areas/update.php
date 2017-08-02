<?php

$this->title = '地区编辑';
$this->params['breadcrumbs'][] = ['label' => '地区列表', 'url' => ['index']];
echo $this->render('_form', ['model' => $model]);
