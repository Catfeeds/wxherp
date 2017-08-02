<?php

$this->title = '广告位新增';
$this->params['breadcrumbs'][] = ['label' => '广告位列表', 'url' => ['index']];
echo $this->render('_form', ['model' => $model]);
