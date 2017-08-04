<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%goods_model}}".
 *
 * @property string $c_id
 * @property string $c_title
 * @property string $c_sort
 * @property string $c_create_time
 * @property string $c_update_time
 */
class GoodsModel extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%goods_model}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_title'], 'required'],
            [['c_sort', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_title'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => '模型ID',
            'c_title' => '模型名称',
            'c_sort' => '排序',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

}
