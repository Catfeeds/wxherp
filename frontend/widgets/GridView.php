<?php

namespace frontend\widgets;

use yii\grid\GridView as YiiGridView;

class GridView extends YiiGridView {

    public $options = ['class' => 'grid-view', 'id' => 'grid'];
    public $layout = '{items}<div class="row"><div class="col-sm-8">{pager}</div><div class="col-sm-4"><div class="pull-right">{summary}</div></div></div>';
    public $emptyText = '暂无数据';
    public $pager = ['firstPageLabel' => '首页', 'prevPageLabel' => '上页', 'nextPageLabel' => '下页', 'lastPageLabel' => '尾页'];
    public $tableOptions = ['class' => 'table table-striped table-bordered table-hover'];
    public $summary = '第{begin} - {end}条 共 {totalCount} 条 共 {pageCount} 页';

}
