<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%goods_category_extend}}".
 *
 * @property string $c_id
 * @property string $c_goods_id
 * @property string $c_category_id
 */
class GoodsCategoryExtend extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%goods_category_extend}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_goods_id', 'c_category_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => '自增主键',
            'c_goods_id' => '商品ID',
            'c_category_id' => '商品类别ID',
        ];
    }

}
