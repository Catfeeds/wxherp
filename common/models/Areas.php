<?php

namespace common\models;

/**
 * This is the model class for table "{{%areas}}".
 *
 * @property string $c_id
 * @property string $c_title
 * @property string $c_postcode
 * @property integer $c_status
 * @property string $c_parent_id
 * @property string $c_sort
 */
class Areas extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%areas}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_status', 'c_parent_id', 'c_sort'], 'integer'],
            [['c_title'], 'string', 'max' => 50],
            [['c_postcode'], 'string', 'max' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => 'ID',
            'c_title' => '地区名称',
            'c_postcode' => '邮政编码',
            'c_status' => '状态 1正常 2无效',
            'c_parent_id' => '父级类别',
            'c_sort' => '排序',
        ];
    }

}
