<?php

namespace common\models;

/**
 * This is the model class for table "{{%feedback}}".
 *
 * @property string $c_id
 * @property string $c_mobile
 * @property string $c_user_name
 * @property string $c_full_name
 * @property string $c_email
 * @property string $c_phone
 * @property string $c_title
 * @property integer $c_sex
 * @property integer $c_is_delete
 * @property integer $c_status
 * @property integer $c_type
 * @property string $c_create_time
 * @property string $c_update_time
 */
class Feedback extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%feedback}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_sex', 'c_is_delete', 'c_status', 'c_type', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_mobile'], 'string', 'max' => 11],
            [['c_user_name', 'c_full_name'], 'string', 'max' => 20],
            [['c_email', 'c_phone', 'c_title'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => 'ID',
            'c_mobile' => '手机号',
            'c_user_name' => '用户名',
            'c_full_name' => '姓名',
            'c_email' => '邮箱',
            'c_phone' => '联系电话',
            'c_title' => '主题',
            'c_sex' => '性别', // 1男 2女 3保密
            'c_is_delete' => '是否删除', // 1已删除 2正常
            'c_status' => '状态', // 1已处理 2未处理 3处理中
            'c_type' => '类型',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

    public function getFeedbackText() {
        return $this->hasOne(FeedbackText::className(), ['c_feedback_id' => 'c_id']);
    }

    public static function getStatus($type = null) {
        $array = [1 => '已处理', 2 => '未处理', 3 => '处理中'];
        return self::getCommonStatus($array, $type);
    }

    /**
     * 保存之后处理相关数据
     * @param type $insert
     * @param type $changedAttributes
     */
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        //正文
        FeedbackText::addEdit($this->c_id, Yii::$app->request->post(self::EDITOR_FIELD_NAME));
    }

}
