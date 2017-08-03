<?php

namespace common\models;

/**
 * This is the model class for table "{{%event_text}}".
 *
 * @property string $c_event_id
 * @property string $c_content
 * @property string $c_create_time
 * @property string $c_update_time
 */
class EventText extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%event_text}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_event_id'], 'required'],
            [['c_event_id', 'c_create_time'], 'integer'],
            [['c_content'], 'string'],
            [['c_update_time'], 'safe'],
            [['c_event_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_event_id' => 'ID',
            'c_content' => '活动正文',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

    public static function addEdit($id, $content) {
        $model = EventText::findOne($id);
        if ($model) {
            $model->c_content = $content;
            return $model->save();
        } else {
            return self::add($id, $content);
        }
    }

    private static function add($id, $content) {
        $model = new EventText();
        $model->c_event_id = $id;
        $model->c_content = $content;
        $model->c_create_time = time();
        return $model->save();
    }

}
