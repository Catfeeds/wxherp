<?php

$this->title = '广告编辑';
$this->params['breadcrumbs'][] = ['label' => '广告列表', 'url' => ['index']];
echo $this->render('_form', ['model' => $model]);
