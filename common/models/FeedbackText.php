<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%feedback_text}}".
 *
 * @property string $c_id
 * @property string $c_parent_id
 * @property string $c_feedback_id
 * @property string $c_user_id
 * @property string $c_user_name
 * @property string $c_content
 * @property string $c_create_time
 */
class FeedbackText extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%feedback_text}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_parent_id', 'c_feedback_id', 'c_user_id', 'c_create_time'], 'integer'],
            [['c_feedback_id'], 'required'],
            [['c_content'], 'string'],
            [['c_user_name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => 'ID',
            'c_parent_id' => '父级ID',
            'c_feedback_id' => 'ID',
            'c_user_id' => '用户ID',
            'c_user_name' => '用户名',
            'c_content' => '反馈内容',
            'c_create_time' => '创建时间',
        ];
    }

    public static function add($id, $content) {
        $model = new FeedbackText();
        $model->c_parent_id = 0;
        $model->c_feedback_id = $id;
        if (!Yii::$app->user->isGuest) {
            $model->c_user_id = Yii::$app->user->id;
            $model->c_user_name = Yii::$app->user->identity->c_user_name;
        }
        $model->c_content = $content;
        $model->save();
    }

    public static function reply($id, $content) {
        $row = FeedbackText::find($id);
        $model = new FeedbackText();
        $model->c_parent_id = $id;
        $model->c_feedback_id = $row->c_feedback_id;
        $model->c_user_id = Yii::$app->user->id;
        $model->c_user_name = Yii::$app->user->identity->c_user_name;
        $model->c_content = $content;
        $model->save();
    }

    public static function editReply($id, $content) {
        $model = FeedbackText::find($id);
        $model->c_content = $content;
        $model->save();
    }

}
