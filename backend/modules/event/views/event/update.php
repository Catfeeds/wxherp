<?php

$this->title = '文章编辑';
$this->params['breadcrumbs'][] = ['label' => '文章列表', 'url' => ['index']];
echo $this->render('_form', ['model' => $model]);
