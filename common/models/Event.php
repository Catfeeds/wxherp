<?php

namespace common\models;

/**
 * This is the model class for table "{{%event}}".
 *
 * @property string $c_id
 * @property string $c_sponsor
 * @property string $c_title
 * @property string $c_address
 * @property string $c_video
 * @property string $c_picture
 * @property string $c_seo
 * @property string $c_keyword
 * @property string $c_description
 * @property integer $c_is_delete
 * @property integer $c_sex
 * @property integer $c_status
 * @property integer $c_type
 * @property integer $c_max
 * @property string $c_favorite_count
 * @property string $c_join_count
 * @property string $c_comment_count
 * @property string $c_favor_count
 * @property string $c_user_id
 * @property string $c_start_time
 * @property string $c_end_time
 * @property string $c_sort
 * @property string $c_hits
 * @property string $c_province_id
 * @property string $c_city_id
 * @property string $c_area_id
 * @property string $c_create_time
 * @property string $c_update_time
 */
class Event extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%event}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_sponsor', 'c_title', 'c_address'], 'required'],
            [['c_is_delete', 'c_sex', 'c_status', 'c_type', 'c_max', 'c_favorite_count', 'c_join_count', 'c_comment_count', 'c_favor_count', 'c_user_id', 'c_start_time', 'c_end_time', 'c_sort', 'c_hits', 'c_province_id', 'c_city_id', 'c_area_id', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_sponsor'], 'string', 'max' => 100],
            [['c_title', 'c_address', 'c_video', 'c_picture', 'c_seo', 'c_keyword', 'c_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => 'ID',
            'c_sponsor' => '活动主办方',
            'c_title' => '活动名称',
            'c_address' => '活动地址',
            'c_video' => '视频地址',
            'c_picture' => '缩略图',
            'c_seo' => '标题优化',
            'c_keyword' => '关键词',
            'c_description' => '描述',
            'c_is_delete' => '是否删除 1已删除 2正常',
            'c_sex' => '性别限制 1 男性 2女性 3不限',
            'c_status' => '状态 1正常 2无效',
            'c_type' => '活动类型',
            'c_max' => '活动预计人数',
            'c_favorite_count' => '收藏数量',
            'c_join_count' => '已报名人数',
            'c_comment_count' => '评论数量',
            'c_favor_count' => '点赞数量',
            'c_user_id' => '用户ID',
            'c_start_time' => '生效时间',
            'c_end_time' => '到期时间',
            'c_sort' => '排序',
            'c_hits' => '点击次数',
            'c_province_id' => '省份',
            'c_city_id' => '市级',
            'c_area_id' => '地区',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

}
