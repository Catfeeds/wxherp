<?php

namespace common\models;

use Yii;
use common\messages\Common;

/**
 * This is the model class for table "{{%system_route}}".
 *
 * @property string $c_id
 * @property string $c_title
 * @property string $c_route
 * @property string $c_icon
 * @property string $c_parent_id
 * @property string $c_sort
 * @property integer $c_status
 * @property string $c_create_time
 * @property string $c_update_time
 */
class SystemRoute extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%system_route}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_title'], 'required'],
            [['c_parent_id', 'c_sort', 'c_status', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_title', 'c_route', 'c_icon'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => 'ID',
            'c_title' => '路由名称',
            'c_route' => '路由地址',
            'c_icon' => '图标',
            'c_parent_id' => '父级类别',
            'c_sort' => '排序',
            'c_status' => '状态', // 1正常 2无效
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if (!$insert) {
                if ($this->c_parent_id == $this->c_id) { //不可以选择自己为自己的父级
                    $this->addError('c_parent_id', Yii::t('common', Common::COMMON_PARENT_ID));
                    return false;
                }
                if (static::checkSub($this->c_id, $this->c_parent_id)) {//不可以选择自己子类为父级菜单
                    $this->addError('c_parent_id', Yii::t('common', Common::COMMON_SUB_ID));
                    return false;
                }
            }
            return true;
        }
        return false;
    }

}
