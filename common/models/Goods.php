<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%goods}}".
 *
 * @property string $c_id
 * @property string $c_title
 * @property string $c_short
 * @property string $c_seo
 * @property string $c_keyword
 * @property string $c_search_keyword
 * @property string $c_description
 * @property string $c_picture
 * @property string $c_number
 * @property string $c_unit
 * @property string $c_cost_price
 * @property string $c_market_price
 * @property string $c_sell_price
 * @property integer $c_status
 * @property string $c_brand_id
 * @property string $c_model_id
 * @property string $c_weight
 * @property string $c_exp
 * @property string $c_point
 * @property string $c_favorite_count
 * @property string $c_grade_count
 * @property string $c_sale_count
 * @property string $c_comment_count
 * @property string $c_store_count
 * @property string $c_hits_count
 * @property string $c_sort
 * @property string $c_up_time
 * @property string $c_down_time
 * @property string $c_create_time
 * @property string $c_update_time
 */
class Goods extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%goods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_title'], 'required'],
            [['c_cost_price', 'c_market_price', 'c_sell_price'], 'number'],
            [['c_status', 'c_brand_id', 'c_model_id', 'c_weight', 'c_exp', 'c_point', 'c_favorite_count', 'c_grade_count', 'c_sale_count', 'c_comment_count', 'c_store_count', 'c_hits_count', 'c_sort', 'c_up_time', 'c_down_time', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_title', 'c_seo', 'c_keyword', 'c_search_keyword', 'c_description', 'c_picture'], 'string', 'max' => 255],
            [['c_short'], 'string', 'max' => 150],
            [['c_number'], 'string', 'max' => 50],
            [['c_unit'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => '商品ID',
            'c_title' => '商品名称',
            'c_short' => '短名称',
            'c_seo' => '标题优化',
            'c_keyword' => '关键词',
            'c_search_keyword' => '商品搜索词库 逗号分隔',
            'c_description' => '描述',
            'c_picture' => '缩略图',
            'c_number' => '商品货号',
            'c_unit' => '计量单位',
            'c_cost_price' => '成本价格',
            'c_market_price' => '市场价格',
            'c_sell_price' => '销售价格',
            'c_status' => '商品状态 1已上架 2待审核 3已下架',
            'c_brand_id' => '品牌ID',
            'c_model_id' => '模型ID',
            'c_weight' => '重量',
            'c_exp' => '经验值',
            'c_point' => '积分',
            'c_favorite_count' => '收藏次数',
            'c_grade_count' => '评分总数',
            'c_sale_count' => '销售总量',
            'c_comment_count' => '评论次数',
            'c_store_count' => '库存总量',
            'c_hits_count' => '点击总数',
            'c_sort' => '排序',
            'c_up_time' => '上架时间',
            'c_down_time' => '下架时间',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

}
