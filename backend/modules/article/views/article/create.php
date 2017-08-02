<?php

$this->title = '文章新增';
$this->params['breadcrumbs'][] = ['label' => '文章列表', 'url' => ['index']];
echo $this->render('_form', ['model' => $model]);
