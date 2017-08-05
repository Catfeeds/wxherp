<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%store}}".
 *
 * @property string $c_id
 * @property string $c_brand
 * @property string $c_title
 * @property string $c_seo
 * @property string $c_keyword
 * @property string $c_description
 * @property string $c_worktime
 * @property string $c_banner
 * @property string $c_picture
 * @property string $c_video
 * @property string $c_email
 * @property string $c_qq
 * @property string $c_wangwang
 * @property string $c_website
 * @property string $c_phone
 * @property string $c_join_phone
 * @property string $c_coordinate
 * @property string $c_address
 * @property string $c_mobile
 * @property string $c_discount
 * @property integer $c_type
 * @property integer $c_is_delete
 * @property integer $c_is_card
 * @property integer $c_is_top
 * @property integer $c_is_recommend
 * @property integer $c_is_upload
 * @property integer $c_is_comment
 * @property integer $c_is_shop
 * @property integer $c_is_join
 * @property integer $c_is_open
 * @property integer $c_claim
 * @property integer $c_status
 * @property string $c_parent_id
 * @property string $c_favorite_count
 * @property string $c_comment_count
 * @property string $c_favor_count
 * @property string $c_create_uid
 * @property string $c_user_id
 * @property string $c_province_id
 * @property string $c_city_id
 * @property string $c_area_id
 * @property string $c_sort
 * @property string $c_hits
 * @property string $c_create_time
 * @property string $c_update_time
 */
class Store extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%store}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_title'], 'required'],
            [['c_discount'], 'number'],
            [['c_type', 'c_is_delete', 'c_is_card', 'c_is_top', 'c_is_recommend', 'c_is_upload', 'c_is_comment', 'c_is_shop', 'c_is_join', 'c_is_open', 'c_claim', 'c_status', 'c_parent_id', 'c_favorite_count', 'c_comment_count', 'c_favor_count', 'c_create_uid', 'c_user_id', 'c_province_id', 'c_city_id', 'c_area_id', 'c_sort', 'c_hits', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_brand', 'c_email', 'c_phone', 'c_join_phone', 'c_coordinate'], 'string', 'max' => 50],
            [['c_title', 'c_website', 'c_address'], 'string', 'max' => 100],
            [['c_seo', 'c_keyword', 'c_description', 'c_worktime', 'c_banner', 'c_picture', 'c_video'], 'string', 'max' => 255],
            [['c_qq'], 'string', 'max' => 15],
            [['c_wangwang'], 'string', 'max' => 25],
            [['c_mobile'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => 'ID',
            'c_brand' => '品牌',
            'c_title' => '商家名称',
            'c_seo' => '标题优化',
            'c_keyword' => '关键词',
            'c_description' => '描述',
            'c_worktime' => '营业时间',
            'c_banner' => '自定义宣传图',
            'c_picture' => '缩略图',
            'c_video' => '视频地址',
            'c_email' => '邮箱',
            'c_qq' => 'QQ',
            'c_wangwang' => '旺旺',
            'c_website' => '网站',
            'c_phone' => '电话',
            'c_join_phone' => '加盟专线',
            'c_coordinate' => '地图经纬度',
            'c_address' => '地址',
            'c_mobile' => '手机号',
            'c_discount' => '会员折扣',
            'c_type' => '商家类型',
            'c_is_delete' => '是否删除', // 1已删除 2正常
            'c_is_card' => '是否支持会员卡', // 1是 2否
            'c_is_top' => '是否置顶', // 1是 2否
            'c_is_recommend' => '是否推荐', // 1是 2否
            'c_is_upload' => '是否允许上传', // 1是 2否
            'c_is_comment' => '是否允许评论', // 1是 2否
            'c_is_shop' => '是否开通在线商城', // 1是 2否
            'c_is_join' => '是否可加盟', // 1是 2否
            'c_is_open' => '是否营业', // 1是 2否
            'c_claim' => '是否已认领', // 1是 2否
            'c_status' => '状态', // 1正常 2无效
            'c_parent_id' => '主店ID',
            'c_favorite_count' => '收藏数量',
            'c_comment_count' => '评论数量',
            'c_favor_count' => '点赞数量',
            'c_create_uid' => '创建用户ID',
            'c_user_id' => '用户ID',
            'c_province_id' => '省份',
            'c_city_id' => '市级',
            'c_area_id' => '地区',
            'c_sort' => '排序',
            'c_hits' => '点击次数',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

    public static function getType($type = null) {
        $array = [3 => '网店', 2 => '实店', 4 => '供应商', 1 => '厂家'];
        return self::getCommonStatus($array, $type);
    }

    public function getProvince() {
        return $this->hasOne(Areas::className(), ['c_id' => 'c_province_id']);
    }

    public function getCity() {
        return $this->hasOne(Areas::className(), ['c_id' => 'c_city_id']);
    }

    public function getArea() {
        return $this->hasOne(Areas::className(), ['c_id' => 'c_area_id']);
    }

    public function getStoreText() {
        return $this->hasOne(StoreText::className(), ['c_store_id' => 'c_id']);
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            //保存缩略图
            if (Yii::$app->request->post(self::PICTURE_FIELD_NAME)) {
                $this->c_picture = Yii::$app->request->post(self::PICTURE_FIELD_NAME);
            }
            if ($insert) {
                $this->c_user_id = Yii::$app->user->id;
                $this->c_create_uid = Yii::$app->user->id;
            }
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
        Upload::updateFile($insert, $this->c_id, Upload::UPLOAD_TYPE_PICTURE, self::FILE_MORE_FILED_NAME);
        //更新编辑器中的图片与文件
        foreach (Yii::$app->params['editor_dir'] as $dir) {
            Upload::updateByPath($this->c_id, Yii::$app->request->post($dir));
        }
        //正文
        StoreText::addEdit($this->c_id, Yii::$app->request->post(self::EDITOR_FIELD_NAME));
    }

    /**
     * 删除之前处理相关数据
     */
    public function beforeDelete() {
        if (parent::beforeDelete()) {
            //删除缩略图 与 相册 与编辑器上传的图片与文件
            Upload::deleteByObject([self::OBJECT_STORE, self::OBJECT_STORE_MORE, self::OBJECT_STORE_EDITOR], $this->c_id);
            //删除正文
            StoreText::deleteAll(['c_article_id' => $this->c_id]);
            return true;
        }
        return false;
    }

}
