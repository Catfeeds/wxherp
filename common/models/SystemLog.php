<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%system_log}}".
 *
 * @property string $c_id
 * @property string $c_user_name
 * @property string $c_note
 * @property string $c_user_id
 * @property integer $c_login_ip
 * @property string $c_create_time
 * @property string $c_update_time
 */
class SystemLog extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%system_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_note'], 'string'],
            [['c_user_id', 'c_login_ip', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_user_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => 'ID',
            'c_user_name' => '用户名',
            'c_note' => '日志内容',
            'c_user_id' => '用户ID',
            'c_login_ip' => '最后登录IP',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

    public static function add($note) {
        $model = new SystemLog();
        $model->c_note = $note;
        $model->c_create_time = time();
        $model->c_user_id = Yii::$app->user->id;
        $model->c_user_name = isset(Yii::$app->user->identity->c_user_name) ? Yii::$app->user->identity->c_user_name : '';
        $model->c_login_ip = ip2long(Yii::$app->getRequest()->getUserIP());
        $result = $model->save();
        return $result;
    }

}
