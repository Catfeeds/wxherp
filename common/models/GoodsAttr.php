<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%goods_attr}}".
 *
 * @property string $c_id
 * @property string $c_attr_value
 * @property string $c_attr_id
 * @property string $c_goods_id
 * @property string $c_model_id
 */
class GoodsAttr extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%goods_attr}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_attr_id', 'c_goods_id', 'c_model_id'], 'integer'],
            [['c_attr_value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => '自增主键',
            'c_attr_value' => '属性值',
            'c_attr_id' => '属性ID',
            'c_goods_id' => '商品ID',
            'c_model_id' => '模型ID',
        ];
    }

}
