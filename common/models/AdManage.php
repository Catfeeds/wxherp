<?php

namespace common\models;

/**
 * This is the model class for table "{{%ad_manage}}".
 *
 * @property string $c_id
 * @property string $c_title
 * @property string $c_url
 * @property string $c_content
 * @property integer $c_type
 * @property integer $c_status
 * @property string $c_position_id
 * @property string $c_sort
 * @property string $c_hits
 * @property string $c_create_time
 * @property string $c_update_time
 */
class AdManage extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%ad_manage}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_content'], 'string'],
            [['c_type', 'c_status', 'c_position_id', 'c_sort', 'c_hits', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_title'], 'string', 'max' => 50],
            [['c_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => 'ID',
            'c_title' => '标题',
            'c_url' => '链接',
            'c_content' => '广告内容 文字、图片、flash、html',
            'c_type' => '广告类型 1文字 2图片 3flash 4html',
            'c_status' => '状态 1正常 2无效',
            'c_position_id' => '广告位ID',
            'c_sort' => '排序',
            'c_hits' => '点击次数',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

}
