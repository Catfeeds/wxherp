<?php

namespace common\models;

/**
 * This is the model class for table "{{%event_user}}".
 *
 * @property string $c_id
 * @property string $c_mobile
 * @property string $c_event_id
 * @property string $c_user_id
 * @property integer $c_status
 * @property string $c_create_time
 * @property string $c_update_time
 */
class EventUser extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%event_user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_mobile', 'c_event_id', 'c_user_id'], 'required'],
            [['c_event_id', 'c_user_id', 'c_status', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_mobile'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => 'ID',
            'c_mobile' => '手机号',
            'c_event_id' => '活动ID',
            'c_user_id' => '用户ID',
            'c_status' => '状态 1正常 2无效',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

}
