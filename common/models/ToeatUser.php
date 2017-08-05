<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%toeat_user}}".
 *
 * @property string $c_id
 * @property string $c_mobile
 * @property string $c_user_name
 * @property string $c_toeat_id
 * @property string $c_user_id
 * @property integer $c_status
 * @property string $c_create_time
 * @property string $c_update_time
 */
class ToeatUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%toeat_user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_mobile', 'c_user_name', 'c_toeat_id', 'c_user_id'], 'required'],
            [['c_toeat_id', 'c_user_id', 'c_status', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_mobile'], 'string', 'max' => 11],
            [['c_user_name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'c_id' => 'ID',
            'c_mobile' => '手机号',
            'c_user_name' => '用户名',
            'c_toeat_id' => '试吃ID',
            'c_user_id' => '用户ID',
            'c_status' => '状态 1正常 2无效',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }
}
