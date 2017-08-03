<?php

namespace common\models;

use Yii;

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
            /**
             * 过滤左右空格
             */
            [['c_sponsor', 'c_title', 'c_address'], 'filter', 'filter' => 'trim'],
            [['c_sponsor', 'c_title', 'c_address', 'c_province_id', 'c_city_id', 'c_max', 'c_type', 'c_status'], 'required'],
            [['c_is_delete', 'c_sex', 'c_status', 'c_type', 'c_max', 'c_favorite_count', 'c_join_count', 'c_comment_count', 'c_favor_count', 'c_user_id', 'c_sort', 'c_hits', 'c_province_id', 'c_city_id', 'c_area_id', 'c_create_time'], 'integer'],
            [['c_update_time', 'c_start_time', 'c_end_time'], 'safe'],
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
            'c_is_delete' => '是否删除', // 1已删除 2正常
            'c_sex' => '性别限制', // 1 男性 2女性 3不限
            'c_status' => '状态', // 1正常 2无效
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

    public static function getType($type = null) {
        $array = [1 => '素时尚', 2 => '健康养生', 3 => '环保', 4 => '灵性', 5 => '关怀动物', 6 => '读书会', 7 => '电影分享', 8 => '培训讲座', 9 => '主题聚会', 10 => '其他'];
        return self::getCommonStatus($array, $type);
    }

    public function getEventUser() {
        return $this->hasMany(EventUser::className(), ['c_event_id' => 'c_id']);
    }

    public function getEventText() {
        return $this->hasOne(EventText::className(), ['c_event_id' => 'c_id']);
    }

    public function getEventAlbum() {
        return $this->hasMany(CommonAlbum::className(), ['c_event_id' => 'c_id']);
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            //保存缩略图
            if (Yii::$app->request->post(self::PICTURE_FIELD_NAME)) {
                $this->c_picture = Yii::$app->request->post(self::PICTURE_FIELD_NAME);
            }
            if ($insert) {
                $this->c_user_id = Yii::$app->user->id;
            }
            $this->c_start_time = strtotime($this->c_start_time);
            $this->c_end_time = strtotime($this->c_end_time);
            return true;
        }
        return false;
    }

    /**
     * 保存之后处理相关数据
     * @param type $insert
     * @param type $changedAttributes
     */
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        //更新缩略图
        Upload::updateFile($insert, $this->c_id);
        //更新相册
        Upload::updateFile($insert, $this->c_id, Upload::UPLOAD_PICTURE, self::FILE_MORE_FILED_NAME);
        //更新编辑器中的图片与文件
        foreach (Yii::$app->params['editor_dir'] as $dir) {
            Upload::updateByPath($this->c_id, Yii::$app->request->post($dir));
        }
        //正文
        EventText::addEdit($this->c_id, Yii::$app->request->post(self::EDITOR_FIELD_NAME));
    }

    /**
     * 删除之前处理相关数据
     */
    public function beforeDelete() {
        if (parent::beforeDelete()) {
            //删除缩略图 与 相册 与编辑器上传的图片与文件
            Upload::deleteByObject([self::OBJECT_EVENT, self::OBJECT_EVENT_MORE, self::OBJECT_EVENT_EDITOR], $this->c_id);
            //删除正文
            EventText::deleteAll(['c_event_id' => $this->c_id]);
            return true;
        }

        return false;
    }

}
