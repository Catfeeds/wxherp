<?php

namespace common\models;

/**
 * This is the model class for table "{{%email_log}}".
 *
 * @property string $c_id
 * @property string $c_title
 * @property string $c_email
 * @property string $c_body
 * @property string $c_param
 * @property string $c_error
 * @property integer $c_type
 * @property integer $c_status
 * @property string $c_user_id
 * @property string $c_send_time
 * @property string $c_create_time
 * @property string $c_update_time
 */
class EmailLog extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%email_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_body', 'c_param', 'c_error'], 'string'],
            [['c_type', 'c_status', 'c_user_id', 'c_send_time', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_title'], 'string', 'max' => 100],
            [['c_email'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => 'ID',
            'c_title' => '邮件标题',
            'c_email' => '邮箱',
            'c_body' => '邮件正文',
            'c_param' => '模板替换参数  JSON格式',
            'c_error' => '邮件发送错误提示信息',
            'c_type' => '消息类型',
            'c_status' => '状态 1成功 2失败 3未发送',
            'c_user_id' => '用户ID',
            'c_send_time' => '预约发送时间 可以用去定时发送',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

}
