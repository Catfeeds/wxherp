<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%goods_category}}".
 *
 * @property string $c_id
 * @property string $c_title
 * @property string $c_short
 * @property string $c_seo
 * @property string $c_keyword
 * @property string $c_description
 * @property string $c_picture
 * @property integer $c_status
 * @property string $c_parent_id
 * @property string $c_sort
 * @property string $c_create_time
 * @property string $c_update_time
 */
class GoodsCategory extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%goods_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_title'], 'required'],
            [['c_status', 'c_parent_id', 'c_sort', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_title'], 'string', 'max' => 50],
            [['c_short'], 'string', 'max' => 150],
            [['c_seo', 'c_keyword', 'c_description', 'c_picture'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => '商品类别ID',
            'c_title' => '类别名称',
            'c_short' => '短标题',
            'c_seo' => '标题优化',
            'c_keyword' => '关键词',
            'c_description' => '描述',
            'c_picture' => '缩略图地址',
            'c_status' => '状态 1正常 2无效',
            'c_parent_id' => '父级ID',
            'c_sort' => '排序',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

}
