<?php

namespace common\models;

/**
 * This is the model class for table "{{%upload}}".
 *
 * @property string $c_id
 * @property string $c_title
 * @property string $c_path
 * @property string $c_extension
 * @property integer $c_object_type
 * @property integer $c_type
 * @property integer $c_user_type
 * @property integer $c_status
 * @property integer $c_width
 * @property integer $c_height
 * @property string $c_object_id
 * @property string $c_user_id
 * @property string $c_size
 * @property string $c_create_time
 * @property string $c_update_time
 */
class Upload extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%upload}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_object_type', 'c_type', 'c_user_type', 'c_status', 'c_width', 'c_height', 'c_object_id', 'c_user_id', 'c_size', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_title'], 'string', 'max' => 50],
            [['c_path'], 'string', 'max' => 255],
            [['c_extension'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => 'ID',
            'c_title' => '原文件名',
            'c_path' => '上传路径',
            'c_extension' => '扩展名',
            'c_object_type' => '项目类型',
            'c_type' => '附件类型 1图片 2附件',
            'c_user_type' => '用户类型 1后台 2用户',
            'c_status' => '状态 2未使用 1正常',
            'c_width' => '图片长度',
            'c_height' => '图片高度',
            'c_object_id' => '对象ID',
            'c_user_id' => '用户ID',
            'c_size' => '文件大小',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

}
