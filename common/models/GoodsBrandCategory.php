<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%goods_brand_category}}".
 *
 * @property string $c_id
 * @property string $c_title
 * @property string $c_sort
 * @property string $c_goods_category_id
 * @property string $c_create_time
 * @property string $c_update_time
 */
class GoodsBrandCategory extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%goods_brand_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_title'], 'required'],
            [['c_sort', 'c_goods_category_id', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_title'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => '品牌类别ID',
            'c_title' => '类别名称',
            'c_sort' => '排序',
            'c_goods_category_id' => '商品类别ID',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

}
