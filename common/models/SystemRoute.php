<?php

namespace common\models;

/**
 * This is the model class for table "{{%system_route}}".
 *
 * @property string $c_id
 * @property string $c_title
 * @property string $c_route
 * @property string $c_icon
 * @property string $c_parent_id
 * @property string $c_sort
 * @property integer $c_status
 * @property string $c_create_time
 * @property string $c_update_time
 */
class SystemRoute extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%system_route}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_title'], 'required'],
            [['c_parent_id', 'c_sort', 'c_status', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_title', 'c_route', 'c_icon'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => 'ID',
            'c_title' => '路由名称',
            'c_route' => '路由地址',
            'c_icon' => '图标',
            'c_parent_id' => '父级类别',
            'c_sort' => '排序',
            'c_status' => '状态 1正常 2无效',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

}
