<?php

namespace common\models;

/**
 * This is the model class for table "{{%common_favorite}}".
 *
 * @property string $c_id
 * @property string $c_category_id
 * @property string $c_user_id
 * @property string $c_object_id
 * @property integer $c_type
 * @property string $c_create_time
 */
class CommonFavorite extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%common_favorite}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_category_id', 'c_user_id', 'c_object_id', 'c_type', 'c_create_time'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => 'ID',
            'c_category_id' => '收藏类别',
            'c_user_id' => '用户ID',
            'c_object_id' => '对象ID',
            'c_type' => '类型',
            'c_create_time' => '创建时间',
        ];
    }

}
