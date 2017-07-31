<?php

namespace common\models;

/**
 * This is the model class for table "{{%user_acount}}".
 *
 * @property string $c_user_id
 * @property string $c_amount
 * @property string $c_frozen_amount
 * @property string $c_exp
 * @property string $c_point
 * @property integer $c_status
 * @property string $c_create_time
 * @property string $c_update_time
 */
class UserAcount extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%user_acount}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_user_id'], 'required'],
            [['c_user_id', 'c_exp', 'c_point', 'c_status', 'c_create_time'], 'integer'],
            [['c_amount', 'c_frozen_amount'], 'number'],
            [['c_update_time'], 'safe'],
            [['c_user_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_user_id' => 'ID',
            'c_amount' => '账户预存款',
            'c_frozen_amount' => '冻结金额',
            'c_exp' => '经验值',
            'c_point' => '积分',
            'c_status' => '状态 1正常 2无效',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

}
