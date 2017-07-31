<?php

namespace common\models;

/**
 * This is the model class for table "{{%config}}".
 *
 * @property string $c_id
 * @property string $c_key
 * @property string $c_content
 */
class Config extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%config}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_key'], 'required'],
            [['c_content'], 'string'],
            [['c_key'], 'string', 'max' => 50],
            [['c_key'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => 'ID',
            'c_key' => '配置键',
            'c_content' => '配置值',
        ];
    }

}
