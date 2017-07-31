<?php

namespace common\models;

/**
 * This is the model class for table "{{%common_tag}}".
 *
 * @property string $c_id
 * @property string $c_title
 * @property string $c_user_id
 * @property string $c_object_id
 * @property string $c_count
 * @property integer $c_type
 * @property string $c_create_time
 * @property string $c_update_time
 */
class CommonTag extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%common_tag}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_title'], 'required'],
            [['c_user_id', 'c_object_id', 'c_count', 'c_type', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_title'], 'string', 'max' => 50],
            [['c_object_id', 'c_type'], 'unique', 'targetAttribute' => ['c_object_id', 'c_type'], 'message' => 'The combination of 对象ID and 标签类型 has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => 'ID',
            'c_title' => '标签',
            'c_user_id' => '用户ID',
            'c_object_id' => '对象ID',
            'c_count' => '标签数量',
            'c_type' => '标签类型',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

}
