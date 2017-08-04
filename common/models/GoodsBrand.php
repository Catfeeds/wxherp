<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%goods_brand}}".
 *
 * @property string $c_id
 * @property string $c_title
 * @property string $c_picture
 * @property string $c_url
 * @property string $c_category_ids
 * @property string $c_seo
 * @property string $c_keyword
 * @property string $c_description
 * @property string $c_sort
 * @property string $c_create_time
 * @property string $c_update_time
 */
class GoodsBrand extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%goods_brand}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_sort', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_title', 'c_picture', 'c_url', 'c_category_ids', 'c_seo', 'c_keyword', 'c_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => '品牌ID',
            'c_title' => '品牌名称',
            'c_picture' => '图片地址',
            'c_url' => '网址',
            'c_category_ids' => '品牌类别ID 逗号分割',
            'c_seo' => '标题优化',
            'c_keyword' => '关键词',
            'c_description' => '描述',
            'c_sort' => '排序',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

}
