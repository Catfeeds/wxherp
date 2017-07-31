<?php

namespace common\models;

/**
 * This is the model class for table "{{%notity_template}}".
 *
 * @property string $c_id
 * @property string $c_title
 * @property string $c_sms_template_code
 * @property string $c_sms_sign_name
 * @property string $c_email_subject
 * @property string $c_web_subject
 * @property string $c_sms_template
 * @property string $c_email_template
 * @property string $c_app_template
 * @property string $c_web_template
 * @property integer $c_status
 * @property integer $c_email_status
 * @property integer $c_sms_status
 * @property integer $c_app_status
 * @property integer $c_web_status
 * @property string $c_type
 * @property string $c_sort
 * @property string $c_create_time
 * @property string $c_update_time
 */
class NotityTemplate extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%notity_template}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_sms_template', 'c_email_template', 'c_app_template', 'c_web_template'], 'string'],
            [['c_status', 'c_email_status', 'c_sms_status', 'c_app_status', 'c_web_status', 'c_type', 'c_sort', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_title', 'c_sms_template_code', 'c_sms_sign_name', 'c_email_subject', 'c_web_subject'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => 'ID',
            'c_title' => '模板描述',
            'c_sms_template_code' => '短信模板ID',
            'c_sms_sign_name' => '短信签名',
            'c_email_subject' => '邮件主题',
            'c_web_subject' => '站内信主题',
            'c_sms_template' => '短信发送模板',
            'c_email_template' => '邮件发送模板',
            'c_app_template' => 'APP推送模板',
            'c_web_template' => '站内信模板',
            'c_status' => '状态 1正常 2无效',
            'c_email_status' => '邮件状态 1正常 2无效',
            'c_sms_status' => '短信状态 1正常 2无效',
            'c_app_status' => 'APP状态 1正常 2无效',
            'c_web_status' => '站内信状态 1正常 2无效',
            'c_type' => '消息类型',
            'c_sort' => '排序',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

}
