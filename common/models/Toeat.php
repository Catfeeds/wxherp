<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%toeat}}".
 *
 * @property string $c_id
 * @property string $c_sponsor
 * @property string $c_seo
 * @property string $c_keyword
 * @property string $c_description
 * @property integer $c_is_delete
 * @property integer $c_sex
 * @property integer $c_status
 * @property integer $c_max
 * @property string $c_restaurant_id
 * @property string $c_favorite_count
 * @property string $c_join_count
 * @property string $c_comment_count
 * @property string $c_favor_count
 * @property string $c_user_id
 * @property string $c_start_time
 * @property string $c_end_time
 * @property string $c_sort
 * @property string $c_hits
 * @property string $c_create_time
 * @property string $c_update_time
 */
class Toeat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%toeat}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_sponsor', 'c_restaurant_id'], 'required'],
            [['c_is_delete', 'c_sex', 'c_status', 'c_max', 'c_restaurant_id', 'c_favorite_count', 'c_join_count', 'c_comment_count', 'c_favor_count', 'c_user_id', 'c_start_time', 'c_end_time', 'c_sort', 'c_hits', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_sponsor'], 'string', 'max' => 100],
            [['c_seo', 'c_keyword', 'c_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c_id' => 'ID',
            'c_sponsor' => '活动主办方',
            'c_seo' => '标题优化',
            'c_keyword' => '关键词',
            'c_description' => '描述',
            'c_is_delete' => '是否删除 1已删除 2正常',
            'c_sex' => '性别限制 1 男性 2女性 3不限',
            'c_status' => '状态 1正常 2无效',
            'c_max' => '活动预计人数',
            'c_restaurant_id' => '餐厅ID',
            'c_favorite_count' => '收藏数量',
            'c_join_count' => '已报名人数',
            'c_comment_count' => '评论数量',
            'c_favor_count' => '点赞数量',
            'c_user_id' => '用户ID',
            'c_start_time' => '生效时间',
            'c_end_time' => '到期时间',
            'c_sort' => '排序',
            'c_hits' => '点击次数',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }
}
