<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%goods_model_attr}}".
 *
 * @property string $c_id
 * @property string $c_title
 * @property string $c_value
 * @property integer $c_type
 * @property integer $c_search
 * @property string $c_model_id
 * @property string $c_create_time
 * @property string $c_update_time
 */
class GoodsModelAttr extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%goods_model_attr}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_value'], 'string'],
            [['c_type', 'c_search', 'c_model_id', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => '自增主键',
            'c_title' => '名称',
            'c_value' => '属性值 逗号分隔',
            'c_type' => '输入控件的类型 1单选 2复选 3下拉 4输入框',
            'c_search' => '搜索 1支持2不支持',
            'c_model_id' => '商品模型ID',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

}
