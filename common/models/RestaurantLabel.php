<?php

namespace common\models;

/**
 * This is the model class for table "{{%restaurant_label}}".
 *
 * @property string $c_restaurant_id
 * @property integer $c_type
 * @property integer $c_value
 */
class RestaurantLabel extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%restaurant_label}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_restaurant_id', 'c_type', 'c_value'], 'required'],
            [['c_restaurant_id', 'c_type', 'c_value'], 'integer'],
            [['c_restaurant_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_restaurant_id' => 'ID',
            'c_type' => '标签类型',
            'c_value' => '标签值',
        ];
    }

}
