<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_profile}}".
 *
 * @property string $c_user_id
 * @property string $c_qq
 * @property string $c_full_name
 * @property string $c_nick_name
 * @property string $c_head
 * @property string $c_phone
 * @property string $c_address
 * @property string $c_sign
 * @property integer $c_sex
 * @property string $c_province_id
 * @property string $c_city_id
 * @property string $c_area_id
 * @property integer $c_birthday
 * @property string $c_create_time
 * @property string $c_update_time
 */
class UserProfile extends _CommonModel {

    //性别类型
    const SEX_MALE = 1; //男
    const SEX_FEMALE = 2; //女
    const SEX_SECRECY = 3; //保密

    public $birthday_year;
    public $birthday_month;
    public $birthday_day;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%user_profile}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_user_id'], 'required'],
            [['c_user_id', 'c_sex', 'c_province_id', 'c_city_id', 'c_area_id', 'c_birthday', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_qq'], 'string', 'max' => 15],
            [['c_full_name'], 'string', 'max' => 20],
            [['c_nick_name', 'c_head', 'c_phone'], 'string', 'max' => 50],
            [['c_address', 'c_sign'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_user_id' => 'ID',
            'c_qq' => 'QQ',
            'c_full_name' => '姓名',
            'c_nick_name' => '昵称',
            'c_head' => '头像',
            'c_phone' => '电话',
            'c_address' => '详细地址',
            'c_sign' => '签名',
            'c_sex' => '性别', // 1男 2女 3保密
            'c_province_id' => '省份ID',
            'c_city_id' => '市级ID',
            'c_area_id' => '地区ID',
            'c_birthday' => '生日',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
        ];
    }

    /**
     * 获取性别
     * @param type $type
     * @return type
     */
    public static function getSexType($type = null) {
        $array = [
            self::SEX_MALE => '男',
            self::SEX_FEMALE => '女',
            self::SEX_SECRECY => '保密'
        ];
        return self::getCommonStatus($array, $type);
    }

    /**
     * 选择性别
     * @param type $type
     * @return type
     */
    public static function getSelectSex($type = null) {
        $array = [
            self::SEX_SECRECY => '不限',
            self::SEX_MALE => '男',
            self::SEX_FEMALE => '女'
        ];
        return self::getCommonStatus($array, $type);
    }

    /**
     * 头像URL地址或物理路径
     * @param type $get_path 是否返回头像的物理路径
     * @param type $id 用户ID
     * @return string
     */
    public static function getHead($get_path = false, $id = 0) {
        $picture = self::getHeadName($id);
        $path = Upload::getUploadPath() . 'user_head' . DIRECTORY_SEPARATOR . $picture;
        if ($get_path) {
            return $path;
        }
        if (is_file($path)) {
            return Upload::getUploadUrl() . 'user_head/' . $picture;
        }
        return self::getHeadNoPic();
    }

    private static function getHeadName($id = 0) {
        $user_id = $id ? $id : Yii::$app->user->getId();
        return md5(md5($user_id)) . '.jpg';
    }

    //头像无图片
    private static function getHeadNoPic() {
        return Upload::getUploadUrl() . 'default/default_user_head.png';
    }

    public static function base64Upload($base64) {
        $img = base64_decode($base64);
        if ($img !== false) {
            $file_path = self::getHead(true); //文件上传的路径
            return file_put_contents($file_path, $img);
        }
        return false;
    }

    public static function addUserProfile($user_id) {
        $model = new UserProfile();
        $model->c_user_id = $user_id;
        $model->c_create_time = time();
        return $model->save();
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if ($this->birthday_year && $this->birthday_month && $this->birthday_day) {
                $this->c_birthday = strtotime($this->birthday_year . '-' . $this->birthday_month . '-' . $this->birthday_day);
            }
            return true;
        }
        return false;
    }

}
