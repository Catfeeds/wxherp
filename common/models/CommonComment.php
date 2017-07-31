<?php

namespace common\models;

/**
 * This is the model class for table "{{%common_comment}}".
 *
 * @property string $c_id
 * @property string $c_user_name
 * @property string $c_content
 * @property integer $c_type
 * @property integer $c_point
 * @property integer $c_status
 * @property string $c_parent_id
 * @property string $c_step_count
 * @property string $c_favor_count
 * @property string $c_object_id
 * @property string $c_user_id
 * @property string $c_create_time
 * @property integer $c_create_ip
 * @property string $c_update_time
 */
class CommonComment extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%common_comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_user_name', 'c_content'], 'required'],
            [['c_type', 'c_point', 'c_status', 'c_parent_id', 'c_step_count', 'c_favor_count', 'c_object_id', 'c_user_id', 'c_create_time', 'c_create_ip'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_user_name'], 'string', 'max' => 20],
            [['c_content'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => 'ID',
            'c_user_name' => '用户名',
            'c_content' => '评论内容',
            'c_type' => '类型',
            'c_point' => '评论分数',
            'c_status' => '审核状态 1已审核 2未审核',
            'c_parent_id' => '父级ID',
            'c_step_count' => '点踩数量',
            'c_favor_count' => '点赞数量',
            'c_object_id' => '对象ID',
            'c_user_id' => '用户ID',
            'c_create_time' => '创建时间',
            'c_create_ip' => '评论IP',
            'c_update_time' => '最后更新时间',
        ];
    }

}
