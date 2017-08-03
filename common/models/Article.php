<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property string $c_id
 * @property string $c_user_name
 * @property string $c_title
 * @property string $c_video
 * @property string $c_picture
 * @property string $c_short
 * @property string $c_seo
 * @property string $c_keyword
 * @property string $c_description
 * @property string $c_author
 * @property string $c_source_url
 * @property integer $c_is_delete
 * @property integer $c_source_type
 * @property integer $c_status
 * @property string $c_category_id
 * @property string $c_favorite_count
 * @property string $c_comment_count
 * @property string $c_step_count
 * @property string $c_favor_count
 * @property string $c_user_id
 * @property string $c_sort
 * @property string $c_hits
 * @property string $c_create_time
 * @property string $c_update_time
 */
class Article extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%article}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            /**
             * 过滤左右空格
             */
            [['c_title', 'c_short', 'c_author', 'c_video', 'c_picture', 'c_seo', 'c_keyword', 'c_description', 'c_source_url', 'c_sort'], 'filter', 'filter' => 'trim'],
            [['c_title', 'c_category_id'], 'required'],
            [['c_is_delete', 'c_source_type', 'c_status', 'c_category_id', 'c_favorite_count', 'c_comment_count', 'c_step_count', 'c_favor_count', 'c_user_id', 'c_sort', 'c_hits', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_user_name'], 'string', 'max' => 20],
            [['c_title', 'c_video', 'c_picture', 'c_seo', 'c_keyword', 'c_description', 'c_source_url'], 'string', 'max' => 255],
            [['c_short', 'c_author'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => 'ID',
            'c_user_name' => '用户名',
            'c_title' => '文章名称',
            'c_video' => '视频地址',
            'c_picture' => '缩略图',
            'c_short' => '短标题',
            'c_seo' => '标题优化',
            'c_keyword' => '关键词',
            'c_description' => '描述',
            'c_author' => '作者',
            'c_source_url' => '来源网址',
            'c_is_delete' => '是否删除', // 1已删除 2正常
            'c_source_type' => '来源类型', // 1原创 2转载
            'c_status' => '状态', // 1正常 2无效
            'c_category_id' => '文章类别',
            'c_favorite_count' => '收藏数量',
            'c_comment_count' => '评论数量',
            'c_step_count' => '点踩数量',
            'c_favor_count' => '点赞数量',
            'c_user_id' => '用户ID',
            'c_sort' => '排序',
            'c_hits' => '点击次数',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

    public static function getSourceType($type = null) {
        $array = [1 => '原创', 2 => '转载'];
        return self::getCommonStatus($array, $type);
    }

    public function getArticleText() {
        return $this->hasOne(ArticleText::className(), ['c_article_id' => 'c_id']);
    }

    public function getArticleCategory() {
        return $this->hasOne(ArticleCategory::className(), ['c_id' => 'c_category_id']);
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            //保存缩略图
            $this->c_picture = Yii::$app->request->post(self::PICTURE_FIELD_NAME);
            if ($insert) {
                $this->c_user_id = Yii::$app->user->id;
                $this->c_user_name = Yii::$app->user->identity->c_user_name;
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
        //更新相册
        Upload::updateFile($insert, $this->c_id, Upload::UPLOAD_PICTURE, self::FILE_MORE_FILED_NAME);
        //更新缩略图
        Upload::updateFile($insert, $this->c_id);
        //正文
        ArticleText::addEdit($this->c_id, Yii::$app->request->post(self::EDITOR_FIELD_NAME));
    }

    /**
     * 删除之前处理相关数据
     */
    public function beforeDelete() {
        if (parent::beforeDelete()) {
            //删除缩略图
            Upload::deleteByObject(self::OBJECT_ARTICLE, $this->c_id);
            //删除相册
            Upload::deleteByObject(self::OBJECT_ARTICLE_MORE, $this->c_id);
            //删除正文
            ArticleText::deleteAll(['c_article_id' => $this->c_id]);
            return true;
        }
        return false;
    }

}
