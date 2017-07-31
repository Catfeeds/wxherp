<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_acount_log}}".
 *
 * @property string $c_id
 * @property string $c_order_no
 * @property string $c_admin_name
 * @property string $c_note
 * @property string $c_amount_old
 * @property string $c_amount
 * @property string $c_amount_new
 * @property string $c_frozen_amount_old
 * @property string $c_frozen_amount
 * @property string $c_frozen_amount_new
 * @property integer $c_type
 * @property string $c_note_type
 * @property string $c_user_id
 * @property string $c_admin_id
 * @property string $c_order_id
 * @property string $c_create_time
 * @property string $c_update_time
 */
class UserAcountLog extends _CommonModel {

    const ACOUNT_ADMIN_ADD = 90; //管理员增加
    const ACOUNT_ADMIN_SUB = 91; //管理员减少
    const ACOUNT_USER_ORDER_SUCCESS = 11; //订单完成赠送
    const ACOUNT_USER_REFUNDMENT = 12; //退款扣除积分经验值

    /**
     * @inheritdoc
     */

    public static function tableName() {
        return '{{%user_acount_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_amount_old', 'c_amount', 'c_amount_new', 'c_frozen_amount_old', 'c_frozen_amount', 'c_frozen_amount_new'], 'number'],
            [['c_type', 'c_note_type', 'c_user_id', 'c_admin_id', 'c_order_id', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_order_no'], 'string', 'max' => 20],
            [['c_admin_name'], 'string', 'max' => 50],
            [['c_note'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => 'ID',
            'c_order_no' => '订单号',
            'c_admin_name' => '管理员用户名',
            'c_note' => '备注说明',
            'c_amount_old' => '账户修改前金额',
            'c_amount' => '修改金额',
            'c_amount_new' => '账户修改后金额',
            'c_frozen_amount_old' => '冻结账户修改前金额',
            'c_frozen_amount' => '修改金额',
            'c_frozen_amount_new' => '冻结账户修改后金额',
            'c_type' => '日志类型', // 1进账 2出账
            'c_note_type' => '备注类型',
            'c_user_id' => '用户ID',
            'c_admin_id' => '管理员ID',
            'c_order_id' => '订单ID',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['c_id' => 'c_user_id']);
    }

    public static function getNote($type = null) {
        $array = [
            self::ACOUNT_ADMIN_ADD => '管理员增加',
            self::ACOUNT_ADMIN_SUB => '管理员减少',
            self::ACOUNT_USER_ORDER_SUCCESS => '订单完成赠送',
            self::ACOUNT_USER_REFUNDMENT => '退款扣除积分经验值',
        ];
        return self::getCommonStatus($array, $type);
    }

    public static function add($data, $user_type = self::CREATE_ADMIN) {
        $model = new UserPointLog();
        if ($user_type == self::CREATE_ADMIN) {
            $model->c_admin_id = Yii::$app->user->identity->c_id;
            $model->c_admin_name = Yii::$app->user->identity->c_user_name;
        }
        $model->attributes = $data;
        $model->c_create_time = time();
        return $model->save();
    }

}
