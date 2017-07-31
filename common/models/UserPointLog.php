<?php

namespace common\models;

/**
 * This is the model class for table "{{%user_point_log}}".
 *
 * @property string $c_id
 * @property string $c_order_no
 * @property string $c_admin_name
 * @property string $c_note
 * @property integer $c_type
 * @property string $c_point_old
 * @property string $c_point
 * @property string $c_point_new
 * @property string $c_exp_old
 * @property string $c_exp
 * @property string $c_exp_new
 * @property string $c_note_type
 * @property string $c_user_id
 * @property string $c_admin_id
 * @property string $c_order_id
 * @property string $c_create_time
 * @property string $c_update_time
 */
class UserPointLog extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%user_point_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_type', 'c_point_old', 'c_point', 'c_point_new', 'c_exp_old', 'c_exp', 'c_exp_new', 'c_note_type', 'c_user_id', 'c_admin_id', 'c_order_id', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_order_no'], 'string', 'max' => 20],
            [['c_admin_name'], 'string', 'max' => 50],
            [['c_note'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => 'ID',
            'c_order_no' => '订单号',
            'c_admin_name' => '管理员用户名',
            'c_note' => '备注说明',
            'c_type' => '日志类型 1进账 2出账',
            'c_point_old' => '修改前积分',
            'c_point' => '修改积分',
            'c_point_new' => '修改后积分',
            'c_exp_old' => '修改前经验值',
            'c_exp' => '修改经验值',
            'c_exp_new' => '修改后经验值',
            'c_note_type' => '备注类型',
            'c_user_id' => '用户ID',
            'c_admin_id' => '管理员ID',
            'c_order_id' => '订单ID',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

}
