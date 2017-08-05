<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%toeat_text}}".
 *
 * @property string $c_toeat_id
 * @property string $c_content
 * @property string $c_create_time
 * @property string $c_update_time
 */
class ToeatText extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%toeat_text}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_toeat_id'], 'required'],
            [['c_toeat_id', 'c_create_time'], 'integer'],
            [['c_content'], 'string'],
            [['c_update_time'], 'safe'],
            [['c_toeat_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c_toeat_id' => 'ID',
            'c_content' => '活动正文',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }
}
