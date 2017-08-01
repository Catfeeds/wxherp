<?php

namespace common\models;

/**
 * This is the model class for table "{{%system_group_node}}".
 *
 * @property string $c_id
 * @property integer $c_status
 * @property string $c_group_id
 * @property string $c_route_id
 * @property string $c_create_time
 * @property string $c_update_time
 */
class SystemGroupNode extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%system_group_node}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_status', 'c_group_id', 'c_route_id', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => 'ID',
            'c_status' => '状态 1正常 2无效',
            'c_group_id' => '管理组ID',
            'c_route_id' => '路由ID',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

    /**
     * 新增或编辑
     * @param type $group_id
     * @param type $route_list
     */
    public static function addEdit($group_id, $route_list) {
        static::deleteAll(['c_group_id' => $group_id]);
        foreach ($route_list as $route_id) {
            self::add($group_id, (int) $route_id);
        }
    }

    private static function add($group_id, $route_id) {
        $model = new SystemGroupNode();
        $model->c_group_id = $group_id;
        $model->c_route_id = $route_id;
        $model->c_status = self::STATUS_YES;
        $model->c_create_time = time();
        $model->save();
    }

}
