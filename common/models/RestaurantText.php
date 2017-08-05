<?php

namespace common\models;

/**
 * This is the model class for table "{{%restaurant_text}}".
 *
 * @property string $c_restaurant_id
 * @property string $c_content
 * @property string $c_dtds_introduce
 * @property string $c_create_time
 * @property string $c_update_time
 */
class RestaurantText extends _CommonModel {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%restaurant_text}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_restaurant_id'], 'required'],
            [['c_restaurant_id', 'c_create_time'], 'integer'],
            [['c_content', 'c_dtds_introduce'], 'string'],
            [['c_update_time'], 'safe'],
            [['c_restaurant_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_restaurant_id' => 'ID',
            'c_content' => '餐厅正文',
            'c_dtds_introduce' => '上门服务介绍',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

    public static function addEdit($id, $content, $dtds) {
        $model = RestaurantText::findOne($id);
        if ($model) {
            $model->c_content = $content;
            $model->c_dtds_introduce = $dtds;
            return $model->save();
        } else {
            return self::add($id, $content, $dtds);
        }
    }

    private static function add($id, $content, $dtds) {
        $model = new RestaurantText();
        $model->c_restaurant_id = $id;
        $model->c_content = $content;
        $model->c_dtds_introduce = $dtds;
        $model->c_create_time = time();
        return $model->save();
    }

}
